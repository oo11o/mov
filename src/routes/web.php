<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/similar', [\App\Http\Controllers\Article\SimilarArticleController::class, 'index']);
Route::get('/similar/{slug}', [\App\Http\Controllers\Article\SimilarArticleController::class, 'show']);
