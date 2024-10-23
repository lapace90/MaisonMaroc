<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('indexAdmin');
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Récupérer uniquement les menus et activités activés
        $menus = Menu::where('status', true)->get();
        $activities = Activity::where('status', true)->get();

        return view('appHome', compact('menus', 'activities'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexAdmin()
    {
        return view('admin.home');
    }
}