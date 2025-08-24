<?php

namespace App\Services\Similar;

use App\DTOs\SimilarMovieArticleDTO;
use App\Repositories\SimilarMoviesRepositoryInterface;
use App\Exceptions\SimilarMovieNotFoundException;

class SimilarMoviesService implements SimilarMoviesServiceInterface
{
    public function __construct(
        private SimilarMoviesRepositoryInterface $similarMoviesRepository,
    ){}

    public function getSimilarMovies(string $name): SimilarMovieArticleDTO
    {
        $articleData = $this->similarMoviesRepository->findSimilarMovieArticle($name);

        if (empty($articleData)) {
            throw new SimilarMovieNotFoundException();
        }

        return new SimilarMovieArticleDTO(...$articleData);
    }
}
