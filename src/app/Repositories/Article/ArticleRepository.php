<?php

namespace App\Repositories\Article;

use App\Enums\ArticleStatusEnum;
use App\Models\Article;

/*
 * Class for managing article data in a database.
 */
class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findPublishedBySlugAndSection(string $slug, string $sectionName): ?Article
    {
        return Article::where('slug', $slug)
            ->where('status', ArticleStatusEnum::PUBLISHED)
            ->whereHas('section', function ($query) use ($sectionName): void {
                $query->where('slug', $sectionName);
            })
            ->first();
    }
}
