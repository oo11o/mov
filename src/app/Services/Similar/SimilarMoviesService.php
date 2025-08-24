<?php

namespace App\Services\Similar;

use App\DTOs\SimilarMovieArticleDTO;
use App\Repositories\SimilarMoviesRepositoryInterface;
use function PHPUnit\Framework\isEmpty;
use App\Exceptions\SimilarMovieNotFoundException;

class SimilarMoviesService implements SimilarMoviesServiceInterface
{
    public function __construct(
        private SimilarMoviesRepositoryInterface $similarMoviesRepository,
    ){}

    public function getSimilarMovies(string $name): SimilarMovieArticleDTO
    {
        $movies = $this->similarMoviesRepository->findSimilarMovies($name);
        if (empty($movies)) {
            throw new SimilarMovieNotFoundException();
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
