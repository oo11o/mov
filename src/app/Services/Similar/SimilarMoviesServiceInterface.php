<?php

namespace App\Services\Similar;

use App\DTOs\SimilarMovieArticleDTO;

/**
 * @throws SimilarMovieNotFoundException
 */
interface SimilarMoviesServiceInterface
{
    public function getSimilarMovies(string $name): SimilarMovieArticleDTO;
}
