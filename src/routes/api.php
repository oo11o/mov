<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ArticleController;




Route::prefix('v1')->group(function () {
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
