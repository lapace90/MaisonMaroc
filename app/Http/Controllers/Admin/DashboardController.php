<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Vérifie si l'utilisateur connecté est un admin
        if (!Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Vous n\'avez pas accès à cette section.');
        }

        // Logique pour afficher le dashboard
        return view('admin.dashboard');
    }
}
