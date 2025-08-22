<?php

namespace App\Http\Controllers;

use App\Services\Similar\SimilarMoviesServiceInterface;
use App\Exceptions\SimilarMovieNotFoundException;
use Illuminate\View\View;

class SimilarMoviesController extends Controller
{
    public function __construct(private readonly SimilarMoviesServiceInterface $similarMoviesService)
    {
    }

    public function show($slug): View
    {
        try {
            $similarMovieArticle = $this->similarMoviesService->getSimilarMovies($slug);
        } catch (SimilarMovieNotFoundException $e) {
            abort(404);
        }
        return view('movies.similar', ['article' => $similarMovieArticle]);
    }
}
