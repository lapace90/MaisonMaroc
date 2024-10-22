<?php

namespace Database\Factories;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    protected $model = Dish::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isVegan = $this->faker->boolean;
        $isVegetarian = $isVegan ? true : $this->faker->boolean;

        return [
            'name' => $this->faker->word,
            'category' => $this->faker->randomElement(['Entrée', 'Plat', 'Soupe', 'Accompagnement', 'Boisson', 'Dessert']),
            'description' => $this->faker->sentence,
            'is_vegetarian' => $isVegetarian,
            'is_vegan' => $isVegan,
        ];
    }
}
