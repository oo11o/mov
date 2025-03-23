<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json([
            'version' => 'v1',
            'articles' => ['Article 1', 'Article 1'],
        ]);
    }
}
