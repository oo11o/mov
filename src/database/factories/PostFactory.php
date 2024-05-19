<?php

namespace Database\Factories;

use App\Enum\PostStatusEnum;
use App\Models\Post;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sections = Section::all();

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'h1' => $this->faker->sentence(4),
            'intro' => $this->faker->paragraph(),
            'content' => $this->faker->paragraph(),
            'section_id' => $sections->random()->id,
            'slug' => $this->faker->slug(),
            'status' => $this->faker->randomElement([
                PostStatusEnum::DRAFT->value,
                PostStatusEnum::PUBLISHED->value,
            ]),
        ];
    }

    public function published(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatusEnum::PUBLISHED,
        ]);
    }

    public function draft(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => PostStatusEnum::DRAFT,
        ]);
    }
}
