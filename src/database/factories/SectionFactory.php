<?php

namespace Database\Factories;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
        ];
    }

    public function createSimilarSection(): self
    {
        return $this->state(fn () => [
           'id' => 1,
           'name' => 'similar',
           'slug' => 'similar',
        ]);
    }
}
