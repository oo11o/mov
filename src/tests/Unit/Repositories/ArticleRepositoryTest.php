<?php

namespace Tests\Unit\Repositories;

use App\Models\Article;
use App\Models\Section;
use App\Repositories\Article\ArticleRepository;
use Tests\TestCase;

class ArticleRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->articleRepository = new ArticleRepository();

        // create article
        $this->section = Section::factory()->createSimilarSection()->create();
        $this->article = Article::factory()->published()->create([
            'section_id' => $this->section->id,
            'slug' => 'test_slug',
        ]);
    }

    public function testFindPublishedArticleBySlugAndSectionSuccess(): void
    {
        $result = $this->articleRepository->findPublishedBySlugAndSection($this->article->slug, $this->section->slug);
        $this->assertNotNull($result);
        $this->assertEquals($this->article->toArray(), $result->toArray());
        $this->assertDatabaseCount('articles', 1);
    }

    public function testFindPublishedBySlugAndCategoryNotFoundBySlug(): void
    {
        $result = $this->articleRepository->findPublishedBySlugAndSection('non-existing-slug', $this->section->slug);
        $this->assertNull($result);
    }

    public function testFindPublishedBySlugAndCategoryNotFoundByCategory(): void
    {
        $result = $this->articleRepository->findPublishedBySlugAndSection($this->article->slug, 'non-existing-section');
        $this->assertNull($result);
    }

    public function testFindPublishedBySlugAndCategoryNotFoundByStatus(): void
    {
        $articleDraft = Article::factory()->draft()->create([
            'section_id' => $this->section->id,
            'slug' => 'slug',
        ]);

        $result = $this->articleRepository->findPublishedBySlugAndSection($articleDraft->slug, $this->section->slug);
        $this->assertNull($result);
    }
}
