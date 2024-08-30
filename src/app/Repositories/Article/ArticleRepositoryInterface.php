<?php

namespace App\Repositories\Article;

use App\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface for a post repository.
 * Provides methods to interact with post data storage.
 */
interface ArticleRepositoryInterface
{
    /**
     * Find a published article by its Slug and SectionName.
     *
     * @param string $slug The slug of the post.
     * @param string $sectionName The name of the section where the post is published.
     * @return Article The post object.
     * @throws ModelNotFoundException If no post is found with the given slug and section name.
     */
    public function findPublishedOrFail(string $slug, string $sectionName): Article;
}
