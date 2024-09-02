<?php

namespace App\Http\Controllers;

use App\Exceptions\Article\SimilarArticleNotFoundException;
use App\Services\Similar\SimilarServiceInterface;
use http\Message\Body;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SimilarController extends Controller
{
    public function __construct(private readonly SimilarServiceInterface $similarService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Display the specified article.
     * @throws SimilarArticleNotFoundException
     */
    public function show(string $slug): ?View
    {
        // Валідація
        $validator = \Validator::make(
            ['slug' => $slug],
            ['slug' => 'required|alpha_dash|max:80']
        );

        if ($validator->fails()) {
            \Log::error('Validation error for slug: ' . $slug . ' - ' . implode(', ', $validator->errors()->all()));
            return abort(404);
        }

        try {
            $article = $this->similarService->getPublishedPostBySlug($slug);
            return view('article.show', ['article' => $article]);
        } catch (SimilarArticleNotFoundException $e) {
            \Log::warning('Similar article not found by slug: ' . $slug . ' - '.$e->getMessage());
            return abort(404);
        } catch (\Exception $e) {
            \Log::error('An unexpected error occurred: ' . $e->getMessage());
            return abort(404);
        }
    }
}
