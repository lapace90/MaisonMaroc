<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Dish;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dishes' => 'required|array', // Assure-toi que les plats sont envoyés sous forme de tableau
        ]);

        // Gérer le téléchargement d'image si besoin
        if ($request->hasFile('photo')) {
            // Code pour stocker l'image
        }

        // Crée le menu
        $menu = Menu::create($validatedData);

        // Associe les plats sélectionnés
        $menu->dishes()->sync($request->dishes);

        return redirect()->route('menus.index')->with('success', 'Menu créé avec succès.');
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
