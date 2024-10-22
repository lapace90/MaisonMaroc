<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DraftController extends Controller
{
    public function index()
    {
        $drafts = Draft::all();
        $draftsActivities = Draft::where('user_id', auth()->id())->where('type', 'activity')->get();
        $draftsMenus = Draft::where('user_id', auth()->id())->where('type', 'menu')->get();
        return view('admin.products.drafts.index', compact('draftsActivities', 'draftsMenus', 'drafts'));
    }


    public function show(Draft $draft)
    {
        return view('drafts.show', compact('draft'));
    }

    public function create()
    {
        return view('drafts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string', // Validation pour le type
        ]);

        $draft = new Draft();
        $draft->name = $request->name;
        $draft->description = $request->description;
        $draft->price = $request->price;
        $draft->user_id = auth()->id();
        $draft->type = $request->type; // Assigne le type


        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('drafts', 'public');
            $draft->photo = $path;
        }

        $draft->save();

        return redirect()->route('drafts.index')->with('success', 'Brouillon créé avec succès.');
    }

    public function edit(Draft $draft)
    {
        return view('drafts.edit', compact('draft'));
    }

    public function update(Request $request, Draft $draft)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string', // Validation pour le type
        ]);

        $draft->name = $request->name;
        $draft->description = $request->description;
        $draft->price = $request->price;
        $draft->type = $request->type; // Assigne le type

        if ($request->hasFile('photo')) {
            // Suppression de l'ancienne photo
            if ($draft->photo) {
                Storage::disk('public')->delete($draft->photo);
            }

            $path = $request->file('photo')->store('drafts', 'public');
            $draft->photo = $path;
        }

        $draft->save();

        return redirect()->route('drafts.index')->with('success', 'Brouillon mis à jour avec succès.');
    }


    public function destroy(Draft $draft)
    {
        $draft->delete();
        return redirect()->route('drafts.index')->with('success', 'Brouillon supprimé avec succès.');
    }
}
