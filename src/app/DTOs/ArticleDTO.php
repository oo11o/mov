<?php

namespace App\DTOs;

use App\Enums\ArticleStatusEnum;
use App\Enums\SectionEnum;
use App\Models\Article;
use Carbon\Carbon;

readonly class ArticleDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public string $h1,
        public string $intro,
        public string $content,
        public string $slug,
        public SectionEnum $section,
        public ArticleStatusEnum $status,
        public Carbon $updated_at,
        public Carbon $created_at,
    ) {
    }

    /**
     * Create an ArticleDTO from an article model.
     *
     * @param Article $article
     * @return self
     */
    public static function fromModel(Article $article): self
    {
        return new self(
            id: $article->id,
            title: $article->title,
            description: $article->description,
            h1: $article->h1,
            intro: $article->intro,
            content: $article->content,
            slug: $article->slug,
            section: SectionEnum::from($article->section_id),
            status: ArticleStatusEnum::from($article->status),
            updated_at: $article->updated_at,
            created_at: $article->created_at,
        );
    }
}
