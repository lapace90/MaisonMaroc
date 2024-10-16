<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        
        // Cherche l'utilisateur dans la base de données
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Crée un nouvel utilisateur si il n'existe pas
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(16)), // Crée un mot de passe temporaire
                // Ajoute d'autres champs si nécessaire
            ]);
        }

        // Authentifie l'utilisateur
        auth()->login($user);   

        // Redirige vers une page appropriée
        return redirect('/home'); // Remplace par la route souhaitée
    }
}