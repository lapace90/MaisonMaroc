<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\Draft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.products.menus.index', compact('menus'));
    }

    public function create()
    {
        $dishes = Dish::all()->groupBy('category'); // Regrouper les plats par catégorie
        return view('admin.products.menus.create', compact('dishes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dishes' => 'required|array',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'price.required' => 'Le prix est obligatoire.',
        ]);
        // Création du menu
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->user_id = auth()->id();

        // Sauvegarder le brouillon
        if ($request->has('draft')) {
            $draft = new Draft();
            $draft->name = $request->name;
            $draft->description = $request->description;
            $draft->price = $request->price;
            $draft->user_id = auth()->id();
            $draft->type = 'menu'; // Indique que c'est un menu

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('drafts', 'public');
                $draft->photo = $path;
            }

            $draft->save();
            $draft->dishes()->sync($request->input('dishes', []));

            return redirect()->route('menus.index')->with('success', 'Menu enregistré dans les brouillons.');
        }

        $menu->save();
        $menu->dishes()->sync($request->input('dishes', []));

        return redirect()->route('menus.index')->with('success', 'Menu enregistré avec succès.');
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        $dishes = $menu->dishes;
        return view('admin.products.menus.show', compact('menu', 'dishes'));
    }


    public function edit($id)
    {
        $menu = Menu::with('dishes')->findOrFail($id);
        $dishes = Dish::all()->groupBy('category');
        return view('admin.products.menus.edit', compact('menu', 'dishes'));
    }

    public function update(Request $request, $id)
    {
        Log::info('Update request received for menu ID: ' . $id);
        Log::info('Request data: ', $request->all());

        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'dishes' => 'required|array',
            'price' => 'required|numeric',
            'status' => 'required|string', // Changez en string pour accepter 'on'/'off'
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Trouver le menu par ID
        $menu = Menu::findOrFail($id);

        // Mise à jour des champs
        $menu->name = $validatedData['name'];
        $menu->description = $validatedData['description'];
        $menu->price = $validatedData['price'];
        $menu->status = ($validatedData['status'] === 'on') ? 1 : 0; // Convertir 'on' en 1 et 'off' en 0
        $menu->dishes()->sync($validatedData['dishes']); // Met à jour les plats associés

        // Gestion de l'image
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($menu->photo) {
                Storage::disk('public')->delete($menu->photo);
            }
            // Enregistrer la nouvelle photo
            $path = $request->file('photo')->store('menus', 'public');
            $menu->photo = $path;
        }

        // Sauvegarder les modifications
        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu mis à jour avec succès.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu supprimé avec succès.');
    }
}