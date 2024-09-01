<?php

namespace App\Services\Similar;

use App\DTOs\ArticleDTO;
use App\Exceptions\Article\SimilarArticleNotFoundException;
use App\Repositories\Article\ArticleRepositoryInterface;

/**
 * Service for managing similar articles.
 */
class SimilarService implements SimilarServiceInterface
{
    private string $sectionName = 'similar';

    public function __construct(
        private readonly ArticleRepositoryInterface $articleRepository)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedPostBySlug(string $slug): ?ArticleDTO
    {
        $article = $this->articleRepository->findPublishedBySlugAndSection($slug, $this->sectionName);

        if (!$article) {
            throw new SimilarArticleNotFoundException('Similar article not found with slug: ' . $slug);
        }

        return ArticleDTO::fromModel($article);
    }
}
