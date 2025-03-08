<?php

namespace App\Services\Similar;

use App\DTOs\ArticleDTO;
use App\Exceptions\Article\SimilarArticleNotFoundException;

interface SimilarServiceInterface
{
    /**
     * Get a published post by its slug.
     *
     * @param string $slug The slug of the article.
     * @return ArticleDTO|null The DTO representing the found post, or null if not found.
     * @throws SimilarArticleNotFoundException
     */
    public function getPublishedArticleBySlug(string $slug): ?ArticleDTO;
}
