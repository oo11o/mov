<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/similar', [\App\Http\Controllers\SimilarController::class, 'index']);

//Route::get('/test', [\App\Http\Controllers\TestController::class, 'index']);
Route::get('/similar/{slug}', [\App\Http\Controllers\SimilarMoviesController::class, 'show']);
