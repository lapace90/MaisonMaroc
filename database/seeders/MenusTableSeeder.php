<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Menu;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create(); // Crée une instance de Faker

        $menus = [
            [
                'name' => 'Menu 1',
                'description' => 'Description du Menu 1',
                'price' => 25.00,
                'photo' => $faker->imageUrl(480, 300, 'menus', true, 'Menus'), // Image aléatoire en ligne
                'user_id' => 5, // Remplace par un ID valide ou génère-le dynamiquement
            ],
            [
                'name' => 'Menu 2',
                'description' => 'Description du Menu 2',
                'price' => 30.00,
                'photo' => $faker->imageUrl(480, 300, 'menus', true, 'Menus'), // Image aléatoire en ligne
                'user_id' => 5,
            ],
            [
                'name' => 'Menu Spécial',
                'description' => 'Un menu spécial avec des plats délicieux.',
                'price' => 50.00,
                'photo' => $faker->imageUrl(480, 300, 'menus', true, 'Menus'),
                'user_id' => 5,
            ],
        ];

        foreach ($menus as $menuData) {
            // Créer le menu
            $menu = Menu::create($menuData);

            // Créer quelques plats et les attacher au menu
            $dishes = Dish::factory()->count(3)->create();
            $menu->dishes()->attach($dishes);
        }
    }
}
