<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\Activity;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    // Affiche la liste des réservations
    public function index()
    {
        $reservations = Reservation::all(); // Récupère toutes les réservations
        return view('admin.reservations.index', compact('reservations')); // Affiche la vue avec les réservations
    }

    // Affiche le formulaire de création d'une nouvelle réservation
    public function create()
    {
        $rooms = RoomType::all();
        $menus = Menu::all();
        $menu = Menu::find(1);
        $activities = Activity::all();
        $dishes = Dish::all();
        return view('admin.reservations.create', compact('menus', 'activities', 'rooms', 'dishes', 'menu')); // Affiche la vue pour ajouter une réservation
    }

    // Stocke une nouvelle réservation
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'check_in_date' => 'required|date_format:d/m/Y',
            'check_out_date' => 'required|date_format:d/m/Y|after:check_in_date',
            'number_of_adults' => 'required|integer|min:1',
            'number_of_children' => 'nullable|integer|min:0',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|string|in:paid,pending,failed',
            'invoice_sent' => 'required|boolean',
            'customer_email' => 'required|email',
            'notes' => 'nullable|string',
            'reservation_menu' => 'nullable|array',
            'reservation_activity' => 'nullable|array',
            'room_type_id' => 'required|exists:room_types,id',
        ]);

        // Parse the dates to the correct format
        $check_in_date = Carbon::createFromFormat('d/m/Y', $request->check_in_date)->format('Y-m-d');
        $check_out_date = Carbon::createFromFormat('d/m/Y', $request->check_out_date)->format('Y-m-d');

        // Crée la réservation avec la date de réservation générée automatiquement
        Reservation::create([
            'customer_name' => $request->customer_name,
            'reservation_date' => now(), // Génère la date actuelle
            'check_in_date' => $check_in_date,
            'check_out_date' => $check_out_date,
            'number_of_adults' => 'required|integer|min:1',
            'number_of_children' => 'nullable|integer|min:0',
            'amount' => $request->amount,
            'payment_status' => $request->payment_status,
            'invoice_sent' => $request->invoice_sent,
            'reservation_menu' => 'nullable|array',
            'reservation_activity' => 'nullable|array',
            'room_type_id' => 'required|exists:room_types,id',
            'customer_email' => $request->customer_email, // Assurez-vous que ce champ existe dans votre modèle
            'notes' => $request->notes,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès.');
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
