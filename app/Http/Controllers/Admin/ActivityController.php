<?php

namespace App\Http\Controllers\Admin;

use App\Models\Draft;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function index()
    {
        // Récupérer toutes les activités
        $activities = Activity::all();
        return view('admin.products.activities.index', compact('activities'));
    }

    public function create()
    {
        // Afficher le formulaire de création d'une nouvelle activité
        return view('admin.products.activities.create');
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

    // Si la validation échoue, on sauvegarde le brouillon
    $draft = new Draft();
    $draft->name = $request->name;
    $draft->description = $request->description;
    $draft->price = $request->price;
    $draft->user_id = auth()->id();
    $draft->type = 'activity'; // Indique que c'est une activité

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('drafts', 'public');
        $draft->photo = $path;
    }

    $draft->save();

    return redirect()->route('activities.index')->with('success', 'Activité enregistrée dans les brouillons.');
}


    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('admin.products.activities.show', compact('activity'));
    }


    public function edit(Activity $activity)
    {
        // Afficher le formulaire d'édition pour une activité spécifique
        return view('admin.products.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer le téléchargement d'image si besoin
        if ($request->hasFile('photo')) {
            // Code pour stocker l'image (par exemple, dans le dossier public)
            $path = $request->file('photo')->store('activities', 'public');
            $validatedData['photo'] = $path; // Ajouter le chemin de l'image validée
        }

        // Mettre à jour l'activité
        $activity->update($validatedData);
        return redirect()->route('admin.products.activities.index')->with('success', 'Activité mise à jour avec succès.');
    }

    public function destroy(Activity $activity)
    {
        // Supprimer une activité spécifique
        $activity->delete();
        return redirect()->route('admin.products.activities.index')->with('success', 'Activité supprimée avec succès.');
    }
}
