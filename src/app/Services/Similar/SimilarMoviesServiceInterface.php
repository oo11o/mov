<?php

namespace App\Services\Similar;

use App\DTOs\SimilarMovieArticleDTO;

interface SimilarMoviesServiceInterface
{
    public function getSimilarMovies(string $name): SimilarMovieArticleDTO;
}
