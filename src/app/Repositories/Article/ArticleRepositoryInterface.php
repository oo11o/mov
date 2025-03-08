<?php

namespace App\Repositories\Article;

use App\Models\Article;

/**
 * Interface for a post repository.
 * Provides methods to interact with post data storage.
 */
interface ArticleRepositoryInterface
{
    /**
     * Find a published article by its Slug and SectionName.
     *
     * @param string $slug The slug of the article.
     * @param string $sectionName The name of the section where the article is published.
     * @return Article|null The article object.
     */
    public function findPublishedBySlugAndSection(string $slug, string $sectionName): ?Article;
}
