<?php

namespace App\Services\Similar;

use Illuminate\Support\Collection;

interface SimilarMoviesServiceInterface
{
    /**
     * @return Collection<MovieDto>
     */
    public function getSimilarMovies(string $name): Collection;
}
