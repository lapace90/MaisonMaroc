<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishesTableSeeder extends Seeder
{
    public function run()
    {
        $dishes = [
            ['name' => 'Couscous', 'category' => 'plat', 'description' => 'Semoule de blé accompagnée de légumes, viandes et sauce.', 'is_vegetarian' => false, 'is_vegan' => false],
            ['name' => 'Tagine de poulet aux citrons confits', 'category' => 'plat', 'description' => 'Poulet cuit lentement avec des citrons confits et des olives.', 'is_vegetarian' => false, 'is_vegan' => false],
            ['name' => 'Pastilla au poulet', 'category' => 'plat', 'description' => 'Feuilleté sucré-salé à base de poulet, d\'amandes et de cannelle.', 'is_vegetarian' => false, 'is_vegan' => false],
            ['name' => 'Harira', 'category' => 'soupe', 'description' => 'Soupe traditionnelle à base de tomates, lentilles et épices, souvent servie pendant le Ramadan.', 'is_vegetarian' => true, 'is_vegan' => false],
            ['name' => 'Briouates', 'category' => 'entrée', 'description' => 'Petits feuilletés farcis, souvent aux amandes ou à la viande.', 'is_vegetarian' => false, 'is_vegan' => false],
            ['name' => 'Mechoui', 'category' => 'plat', 'description' => 'Agneau rôti à la broche, souvent servi lors des grandes occasions.', 'is_vegetarian' => false, 'is_vegan' => false],
            ['name' => 'Zaalouk', 'category' => 'accompagnement', 'description' => 'Salade d\'aubergines et tomates épicées, servie froide.', 'is_vegetarian' => true, 'is_vegan' => true],
            ['name' => 'Tajine de kefta', 'category' => 'plat', 'description' => 'Boulettes de viande hachée cuites dans une sauce tomate épicée.', 'is_vegetarian' => false, 'is_vegan' => false],
            ['name' => 'Rfissa', 'category' => 'plat', 'description' => 'Plat à base de poulet, lentilles et pain frit, souvent servi lors des célébrations.', 'is_vegetarian' => false, 'is_vegan' => false],
            ['name' => 'Ghriba', 'category' => 'dessert', 'description' => 'Biscuit marocain à base d\'amandes ou de noix de coco.', 'is_vegetarian' => true, 'is_vegan' => true],
        ];

        DB::table('dishes')->insert($dishes);
    }
}

