<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Art>
 */
class ArtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $numberOfWordsInTitle = fake()->numberBetween(1, 5);
        return [
            'title' => fake()->words($numberOfWordsInTitle, true),
            'year' => fake()->numberBetween(1000, date("Y")),
            'value' => fake()->numberBetween(100, 450300000)
        ];
    }
}
