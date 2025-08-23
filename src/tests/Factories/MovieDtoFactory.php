<?php

namespace Tests\Factories;

class MovieDtoFactory
{
    public static function make(array $overrides = []): MovieDto
    {
        $faker = Faker::create();

        return new MovieDto(
            title: $overrides['title'] ?? $faker->sentence(2),
            year: $overrides['year'] ?? (int) $faker->year
        );
    }
}
