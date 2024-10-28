<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Activity;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    // Affiche la liste des réservations
    public function index()
    {
        $reservations = Reservation::all(); // Récupère toutes les réservations
        return view('admin.reservations.index', compact('reservations')); // Affiche la vue avec les réservations
    }

    public function reservationList()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.list', compact('reservations'));
    }

    // Affiche le formulaire de création d'une nouvelle réservation
    public function create()
    {
        $rooms = RoomType::all();
        $menus = Menu::all();
        $menu = Menu::find(1);
        $activities = Activity::all();
        return view('admin.reservations.create', compact('menus', 'activities', 'rooms', 'menu')); // Affiche la vue pour ajouter une réservation
    }

    // Stocke une nouvelle réservation
    public function store(Request $request)
    {
        // Transformez le format des dates avant la validation
        $request->merge([
            'check_in_date' => Carbon::createFromFormat('d/m/Y', $request->check_in_date)->format('Y-m-d'),
            'check_out_date' => Carbon::createFromFormat('d/m/Y', $request->check_out_date)->format('Y-m-d'),
        ]);

        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'reservation_date' => now(), // Ajoutez cette ligne pour la date de réservation
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date',
            'number_of_adults' => 'required|integer|min:1',
            'number_of_children' => 'nullable|integer|min:0',
            'room_type_id' => 'required|exists:room_types,id',
            'res_menus' => 'nullable|array',
            'res_activities' => 'nullable|array',
            'amount' => 'required|numeric',
            'payment_status' => 'required|string',
            'customer_email' => 'required|email',
            'notes' => 'nullable|string',
        ]);

        // Crée la réservation avec la date de réservation générée automatiquement
        $reservation = Reservation::create($validatedData);
        // Ajouter les menus à la table pivot
        if ($request->has('res_menus')) {
            $reservation->menus()->attach($request->input('res_menus'));
        }

        // Ajouter les activités à la table pivot
        if ($request->has('res_activities')) {
            $reservation->activities()->attach($request->input('res_activities'));
        }

        return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès.');
    }

    public function show($id)
    {
        $reservation = Reservation::with(['menus', 'activities'])->findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    // Affiche le formulaire d'édition d'une réservation
    public function edit($id)
    {
        $reservation = Reservation::with(['menus', 'activities'])->findOrFail($id);
        $menus = Menu::all();
        $activities = Activity::all();
        $rooms = RoomType::all();
        return view('admin.reservations.edit', compact('reservation', 'menus', 'activities', 'rooms'));
    }

    // Met à jour une réservation
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'reservation_date' => 'required|date',
            'room_type_id' => 'required|exists:room_types,id',
            'number_of_adults' => 'required|integer|min:1',
            'number_of_children' => 'nullable|integer|min:0',
            'amount' => 'required|numeric',
            'reservation_menu' => 'nullable|array',
            'reservation_activity' => 'nullable|array',
            'payment_status' => 'string|in:paid,pending,failed',
            'invoice_sent' => 'boolean',
            'notes' => 'nullable|string',
        ]);


        $reservation->update($request->all()); // Met à jour la réservation avec les données validées

        return redirect()->route('admin.reservations.index')->with('success', 'Réservation mise à jour avec succès.'); // Redirige vers la liste avec un message de succès
    }

    // Supprime une réservation
    public function destroy(Reservation $reservation)
    {
        $reservation->delete(); // Supprime la réservation
        return redirect()->route('admin.reservations.index')->with('success', 'Réservation supprimée avec succès.'); // Redirige vers la liste avec un message de succès
    }
}
