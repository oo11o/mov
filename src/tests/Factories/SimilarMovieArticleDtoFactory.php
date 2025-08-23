<?php

namespace App\tests\Factories;

class SimilarMovieArticleDtoFactory
{
    public static function make(array $overrides = []): SimilarMovieArticleDto
    {
        $faker = Faker::create();

        return new SimilarMovieArticleDto(
            title: $overrides['title'] ?? $faker->sentence,
            h1: $overrides['h1'] ?? $faker->sentence,
            description: $overrides['description'] ?? $faker->paragraph,
            intro: $overrides['intro'] ?? $faker->sentence,
            movies: $overrides['movies'] ?? collect([])
        );
    }
}
