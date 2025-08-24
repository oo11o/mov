<?php

namespace App\Services\Similar;

use App\DTOs\SimilarMovieArticleDTO;
use App\Repositories\SimilarMoviesRepositoryInterface;

class SimilarMoviesService implements SimilarMoviesServiceInterface
{
    public function __construct(
        private SimilarMoviesRepositoryInterface $similarMoviesRepository,
    ){}

    public function getSimilarMovies(string $name): SimilarMovieArticleDTO
    {
        $movies = $this->similarMoviesRepository->findSimilarMovies($name);

        if ($movies === null || $movies->isEmpty()) {
            throw new SimilarMovieNotFoundException("No similar movies found for '{$name}'");
        }

        return new SimilarMovieArticleDTO(
            title: "Similar Movies: {$name}",
            h1: "Top Similar Movies",
            description: "Description of {$name} movies",
            intro: "Here are some movies similar to {$name}",
            movies: $movies
        );
    }
}
