<?php

namespace Database\Factories;

use App\Enum\ArticleStatusEnum;
use App\Models\Article;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
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
                ArticleStatusEnum::DRAFT->value,
                ArticleStatusEnum::PUBLISHED->value,
            ]),
        ];
    }

    public function published(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => ArticleStatusEnum::PUBLISHED->value,
        ]);
    }

    public function draft(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => ArticleStatusEnum::DRAFT->value,
        ]);
    }
}
