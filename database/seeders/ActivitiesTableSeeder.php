<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use Faker\Factory as Faker;;

class ActivitiesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Crée une instance de Faker

        foreach (range(1, 10) as $index) {
            Activity::create([
                'name' => $faker->sentence(3), // Titre de l'activité
                'description' => $faker->paragraph, // Description de l'activité
                'price' => $faker->randomFloat(2, 30, 200), // Prix de l'activité
                'duration' => $faker->numberBetween(1, 5) . ' heures', // Durée
                'image' => $faker->imageUrl(640, 480, 'activities', true, 'Activity') // Image aléatoire en ligne
            ]);
        }
    }
}
