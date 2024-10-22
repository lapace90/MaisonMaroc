<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\Draft;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'price.required' => 'Le prix est obligatoire.',
        ]);

        // Sauvegarder le brouillon
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

        return redirect()->route('menus.index')->with('success', 'Menu enregistré dans les brouillons.');
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        $dishes = $menu->dishes;
        return view('admin.products.menus.show', compact('menu', 'dishes'));
    }


    public function edit(Menu $menu)
    {
        return view('admin.products.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer le téléchargement d'image si besoin

        $menu->update($validatedData);
        return redirect()->route('admin.products.menus.index')->with('success', 'Menu mis à jour avec succès.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.products.menus.index')->with('success', 'Menu supprimé avec succès.');
    }
}
