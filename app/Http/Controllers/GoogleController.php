<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Rediriger l'utilisateur vers Google pour l'authentification.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Gérer le callback de Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
            $driver = Socialite::driver('google');

            // Appelle la méthode stateless() 
            $googleUser = $driver->stateless()->user();

            // Vérifiez si l'utilisateur existe déjà dans votre base de données
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Si l'utilisateur n'existe pas, créez-le
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // Vous pouvez générer un mot de passe aléatoire
                ]);
            }

            // Authentifiez l'utilisateur
            Auth::login($user, true);

            // Redirigez vers la page d'accueil ou une autre page
            return redirect()->route('home'); // Assurez-vous d'avoir une route 'home'
        } catch (\Exception $e) {
            return redirect('/'); // Redirigez vers la page d'accueil en cas d'erreur
        }
    }
}
