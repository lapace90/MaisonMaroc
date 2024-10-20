<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('test'), // Définit le mot de passe ici
            //'password' => bcrypt('password'), // Utilise bcrypt pour hasher le mot de passe
            'is_admin' => true,
        ]);
    }
}
