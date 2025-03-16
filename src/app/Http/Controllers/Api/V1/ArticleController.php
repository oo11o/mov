<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json([
            'version' => 'v1',
            'articles' => ['Article 1', 'Article 1']
        ]);
    }
}
