<?php

namespace Database\Factories;

use App\Enums\ArticleStatusEnum;
use App\Enums\SectionEnum;
use App\Models\Article;
use Carbon\Carbon;
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
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(1),
            'h1' => $this->faker->sentence(4),
            'intro' => $this->faker->paragraph(),
            'content' => $this->faker->paragraph(),
            'section_id' => $this->faker->randomElement(SectionEnum::getAllValues()),
            'slug' => $this->faker->slug(),
            'status' => $this->faker->randomElement(ArticleStatusEnum::getAllValues()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
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
