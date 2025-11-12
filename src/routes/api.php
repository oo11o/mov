<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/articles', function () {
        return response()->json([
            'message' => 'This is a JSON response',
            'status' => 'success',
        ]);
    });
});


Route::prefix('v1')->group(function (): void {
    Route::get('/movies', function () {
        return response()->json([
            'message' => 'This is a JSON response',
            'status' => 'success',
        ]);
    });
    Route::post('/movies', \App\Http\Controllers\Api\V1\MoviesController::class.'@store');
});
Route::prefix('v1')->group(function (): void {
    Route::get('/articles', function () {
        return response()->json([
            'message' => 'This is a JSON response',
            'status' => 'success',
        ]);
    });
});




//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
