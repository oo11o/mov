<?php

namespace App\DTOs;

use Illuminate\Support\Collection;

readonly class SimilarMovieArticleDTO
{
    public function __construct(
        public string $title,
        public string $h1,
        public string $description,
        public string $intro,
        /** @var Collection<MovieDto> */
        public Collection $movies,
    ) {
    }
}
