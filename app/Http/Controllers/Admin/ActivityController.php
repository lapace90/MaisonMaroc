<?php

namespace App\Http\Controllers\Admin;

use App\Models\Draft;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        // Récupérer toutes les activités
        $activities = Activity::all();

        // Optionnel : ajouter une clé pour la durée formatée
        foreach ($activities as $activity) {
            $activity->formatted_duration = $this->convertMinutesToHours($activity->duration);
        }

        return view('admin.products.activities.index', compact('activities'));
    }

    public function convertMinutesToHours($durationInMinutes)
    {
        $hours = floor($durationInMinutes / 60); // Calcul des heures
        $minutes = $durationInMinutes % 60; // Calcul des minutes restantes

        return sprintf('%02dh%02d', $hours, $minutes); // Formatage en HH:MM
    }

    public function create()
    {
        // Récupérer toutes les activités
        $activities = Activity::all();

        // Optionnel : ajouter une clé pour la durée formatée
        foreach ($activities as $activity) {
            $activity->formatted_duration = $this->convertMinutesToHours($activity->duration);
        }
        return view('admin.products.activities.create', compact('activity'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer|min:30|max:300',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'price.required' => 'Le prix est obligatoire.',
        ]);

        // Créer une nouvelle activité
        $activity = new Activity();
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->price = $request->price;
        $activity->user_id = auth()->id();
        $activity->duration = $request->duration;
        $activity->status = ($request->status === 'on') ? 1 : 0;


        // Si la validation échoue, on sauvegarde le brouillon
        if ($request->has('draft')) {
            $draft = new Draft();
            $draft->name = $request->name;
            $draft->description = $request->description;
            $draft->price = $request->price;
            $draft->user_id = auth()->id();
            $draft->type = 'activity'; // Indique que c'est une activité

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('drafts', 'public');
                $draft->image = $path;
            }

            $draft->save();

            return redirect()->route('activities.index')->with('success', 'Activité enregistrée dans les brouillons.');
        }

        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Activité enregistrée avec succès.');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|integer|min:30|max:300',
            'status' => 'required|string',  // Validation du status
        ]);

        $activity = Activity::findOrFail($activity->id);

        //Mise à jour des champs
        $activity->name = $validatedData['name'];
        $activity->description = $validatedData['description'];
        $activity->price = $validatedData['price'];
        $activity->duration = $validatedData['duration'];
        $activity->status = ($validatedData['status'] === 'on') ? 1 : 0;


        // Gérer le téléchargement d'image si besoin
        if ($request->hasFile('image')) {
            if ($activity->image) {
                // Supprimer l'ancienne image
                Storage::disk('public')->delete($activity->image);
            }
            // Code pour stocker l'image dans le dossier 'storage/app/public/activities'
            $path = $request->file('image')->store('activities', 'public');
            $validatedData['image'] = $path; // Ajouter le chemin de l'image validée
        }

        // Mettre à jour l'activité

        $activity->save();
        return redirect()->route('activities.index')->with('success', 'Activité mise à jour avec succès.');
    }

    public function destroy(Activity $activity)
    {
        // Supprimer une activité spécifique
        $activity->delete();
        return redirect()->route('admin.products.activities.index')->with('success', 'Activité supprimée avec succès.');
    }
}
