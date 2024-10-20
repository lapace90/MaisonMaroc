<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function index()
    {
        // Logique pour récupérer les données d'agenda (par exemple, réservations, etc.)
        return view('admin.agenda.index'); // Crée cette vue pour afficher l'agenda
    }
}
