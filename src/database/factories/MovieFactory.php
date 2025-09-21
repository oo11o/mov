<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words($this->faker->numberBetween(2, 4), true)),
            'description' => $this->faker->paragraph(),
            'year' => $this->faker->numberBetween(1980, 2025),
        ];
    }
}
