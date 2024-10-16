<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Valida i dati del modulo
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        // Invia il messaggio (puoi utilizzare Mail per inviare un'email)
        // Mail::to('your_email@example.com')->send(new ContactForm($request->all()));

        return back()->with('success', 'Message sent successfully!');
    }
}
