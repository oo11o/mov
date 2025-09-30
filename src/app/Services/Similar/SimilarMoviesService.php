<?php

namespace App\Services\Similar;

use App\DTOs\MovieDTO;
use App\DTOs\SimilarMovieArticleDTO;
use App\Exceptions\SimilarMovieNotFoundException;
use App\Repositories\Article\ArticleRepository;

class SimilarMoviesService implements SimilarMoviesServiceInterface
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
    ) {
    }

    public function getSimilarMovies(string $slug): SimilarMovieArticleDTO
    {
        $article = $this->articleRepository->findBySlug($slug);

        if (empty($article)) {
            throw new SimilarMovieNotFoundException();
        }

        $moviesCollection = $article->movies->map(fn ($m) => new MovieDto(
            title: $m->title,
            year: $m->year,
            description: $m->description,
        ));

        return new SimilarMovieArticleDTO(
            title: $article->title,
            h1: $article->h1,
            description: $article->description,
            intro: $article->intro,
            movies: $moviesCollection,
        );
    }
}
