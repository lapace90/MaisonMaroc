<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

    public function showLoginForm()
    {
        return view('auth.login'); // Assurez-vous que cette vue existe
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Authentification réussie
            return redirect()->intended('/admin/dashboard'); // Redirige vers le tableau de bord
        }
  
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
