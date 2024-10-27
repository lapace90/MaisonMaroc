<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room_types = [
            ['name' => 'Chambre Standard', 'price' => 100, 'adult_rate' => 100, 'child_rate' => 50],
            ['name' => 'Suite de Luxe', 'price' => 200, 'adult_rate' => 200, 'child_rate' => 100],
            ['name' => 'Tente de Glamping', 'price' => 150, 'adult_rate' => 150, 'child_rate' => 75],
            ['name' => 'Cabane dans les Arbres', 'price' => 180, 'adult_rate' => 180, 'child_rate' => 90],
            ['name' => 'Chambre Familiale', 'price' => 250, 'adult_rate' => 250, 'child_rate' => 125],
        ];
        DB::table('room_types')->insert($room_types);
    }
}
