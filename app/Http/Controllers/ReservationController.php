<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('admin.reservations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'reservation_date' => 'required|date', // Validate as date
            'check_in_date' => 'required|date|after_or_equal:reservation_date',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_people' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|string|in:paid,pending,failed',
            'invoice_sent' => 'required|boolean',
            'customer_email' => 'required|email',
            'notes' => 'nullable|string',
        ]);
    
        $reservation = new Reservation();
        $reservation->customer_name = $validatedData['customer_name'];
        $reservation->reservation_date = now(); // Set the reservation date to the current timestamp
        $reservation->check_in_date = $validatedData['check_in_date'];
        $reservation->check_out_date = $validatedData['check_out_date'];
        $reservation->number_of_people = $validatedData['number_of_people'];
        $reservation->amount = $validatedData['amount'];
        $reservation->payment_status = $validatedData['payment_status'];
        $reservation->invoice_sent = $validatedData['invoice_sent'];
        $reservation->customer_email = $validatedData['customer_email'];
        $reservation->notes = $validatedData['notes'];
        $reservation->save();
    
        return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès.');
    }
}
