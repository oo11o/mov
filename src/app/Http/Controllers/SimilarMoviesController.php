<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Similar\SimilarMoviesServiceInterface;

class SimilarMoviesController extends Controller
{
    public function __construct(private SimilarMoviesServiceInterface $similarMoviesService)
    {
    }

    public function show($slug)
    {
        $article = $this->similarMoviesService->getSimilarMovies($slug);

        return view('movies.similar', compact('article'));
    }
}
