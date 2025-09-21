<?php

namespace App\DTOs;

readonly class MovieDTO
{
    public function __construct(
        public string $title,
        public int $year,
        public string $description,
    ) {
    }
}
