<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Menu;
use App\Models\Activity;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DraftController extends Controller
{
    public function index()
    {
        $drafts = Draft::all();
        $draftsActivities = Draft::where('user_id', auth()->id())->where('type', 'activity')->get();
        $draftsMenus = Draft::where('user_id', auth()->id())->where('type', 'menu')->get();
        // Formatage de la durée des activités
        foreach ($draftsActivities as $draft) {
            $draft->formatted_duration = $this->convertMinutesToHours($draft->duration);
        }
        return view('admin.products.drafts.index', compact('draftsActivities', 'draftsMenus', 'drafts'));
    }

    public function show(Draft $draft)
    {
        $dishes = $draft->dishes; // Get the dishes associated with the draft
        return view('admin.products.drafts.show', compact('draft', 'dishes'));
    }

    public function create()
    {
        $dishes = Dish::all()->groupBy('category');
        return view('admin.products.drafts.create', compact('dishes'));
    }

    public function storeMenuDraft(Request $request)
    {
        $validatedData = $this->validateMenuDraft($request);

        $draft = new Draft();
        $draft->name = $validatedData['name'];
        $draft->description = $validatedData['description'];
        $draft->price = $validatedData['price']; // Store price as float
        $draft->user_id = auth()->id();
        $draft->type = 'menu';

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('menu_drafts', 'public');
            $draft->photo = $path;
        }

        $draft->save();
        $draft->dishes()->sync($request->input('dishes', []));

        return redirect()->route('drafts.index')->with('success', 'Brouillon de menu créé avec succès.');
    }

    public function storeActivityDraft(Request $request)
    {
        $validatedData = $this->validateActivityDraft($request);

        $draft = new Draft();
        $draft->name = $validatedData['name'];
        $draft->description = $validatedData['description'];
        $draft->price = $validatedData['price']; // Store price as float
        $draft->duration = $validatedData['duration'];
        $draft->user_id = auth()->id();
        $draft->type = 'activity';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('activity_drafts', 'public');
            $draft->image = $path;
        }

        $draft->save();

        return redirect()->route('drafts.index')->with('success', 'Brouillon d\'activité créé avec succès.');
    }

    public function edit(Draft $draft)
    {
        $dishes = Dish::all()->groupBy('category');
        return view('admin.products.drafts.edit', compact('draft', 'dishes'));
    }

    public function update(Request $request, Draft $draft)
    {
        if ($draft->type == 'menu') {
            $validatedData = $this->validateMenuDraft($request);
        } else {
            $validatedData = $this->validateActivityDraft($request);
        }

        $draft->name = $validatedData['name'];
        $draft->description = $validatedData['description'];
        $draft->price = $validatedData['price']; // Store price as float

        if ($request->hasFile('photo') || $request->hasFile('image')) {
            if ($draft->photo) {
                Storage::disk('public')->delete($draft->photo);
            }

            $draft->photo = $this->storeImage($request);
        }

        $draft->save();
        $draft->dishes()->sync($request->input('dishes', []));

        // Validate and move the draft if everything is correct
        return $this->validateAndMoveDraft($draft);
    }

    public function destroy(Draft $draft)
    {
        if ($draft->photo) {
            Storage::disk('public')->delete($draft->photo);
        }

        $draft->delete();
        return redirect()->route('drafts.index')->with('success', 'Brouillon supprimé avec succès.');
    }

    public function validateAndMoveDraft(Draft $draft)
    {
        if ($draft->type == 'menu') {
            $menu = new Menu();
            $menu->name = $draft->name;
            $menu->description = $draft->description;
            $menu->price = $draft->price;
            $menu->photo = $draft->photo;
            $menu->user_id = $draft->user_id;
            $menu->save();
            $menu->dishes()->sync($draft->dishes->pluck('id')->toArray());
        } else {
            $activity = new Activity();
            $activity->name = $draft->name;
            $activity->description = $draft->description;
            $activity->price = $draft->price;
            $activity->duration = $draft->duration;
            $activity->image = $draft->image;
            $activity->user_id = $draft->user_id;
            $activity->save();
        }

        $draft->delete();
        return redirect()->route('drafts.index')->with('success', 'Brouillon validé et déplacé avec succès.');
    }

    private function validateMenuDraft(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dishes' => 'required|array',
        ]);
    }

    private function validateActivityDraft(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:30|max:300',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    private function storeImage(Request $request)
    {
        if ($request->hasFile('photo')) {
            return $request->file('photo')->store('drafts', 'public');
        } elseif ($request->hasFile('image')) {
            return $request->file('image')->store('drafts', 'public');
        }
        return null;
    }
}
