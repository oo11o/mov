<?php

namespace Tests\Unit\Repositories;

use App\Models\Article;
use App\Models\Movie;
use App\Models\Section;
use App\Repositories\Article\ArticleRepository;
use PHPUnit\Framework\Attributes\Test;
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
            'title' => 'Article Test Title',
        ]);

        $this->movies = Movie::factory()->count(10)->create();
        $this->article->movies()->attach($this->movies->pluck('id'));
    }

    #[Test]
    public function it_returns_article_by_slug(): void
    {
        $result = $this->articleRepository->findBySlug($this->article->slug);
        $this->assertInstanceOf(Article::class, $result);

        $this->assertTrue($result->relationLoaded('movies'));
        $this->assertCount(10, $result->movies);
        $this->assertEqualsCanonicalizing(
            $this->movies->pluck('id')->toArray(),
            $result->movies->pluck('id')->toArray()
        );

        $this->assertEquals($this->article->id, $result->id);
        $this->assertEquals($this->article->slug, $result->slug);
        $this->assertEquals($this->article->title, $result->title);
    }

    #[Test]
    public function it_returns_article_without_movies(): void
    {
        $articleWithoutMovies = Article::factory()->published()->create([
            'section_id' => $this->section->id,
            'slug' => 'article_without_movies',
        ]);

        $result = $this->articleRepository->findBySlug($articleWithoutMovies->slug);

        $this->assertInstanceOf(Article::class, $result);
        $this->assertTrue($result->relationLoaded('movies'));
        $this->assertCount(0, $result->movies);
    }

    #[Test]
    public function it_returns_null_if_article_not_found(): void
    {
        $result = $this->articleRepository->findBySlug('not-existing-slug');
        $this->assertNull($result);
    }

    //    public function testFindPublishedArticleBySlugAndSectionSuccess(): void
    //    {
    //        $result = $this->articleRepository->findPublishedBySlugAndSection($this->article->slug, $this->section->slug);
    //        $this->assertNotNull($result);
    //        $this->assertEquals($this->article->toArray(), $result->toArray());
    //        $this->assertDatabaseCount('articles', 1);
    //    }
    //
    //    public function testFindPublishedBySlugAndCategoryNotFoundBySlug(): void
    //    {
    //        $result = $this->articleRepository->findPublishedBySlugAndSection('non-existing-slug', $this->section->slug);
    //        $this->assertNull($result);
    //    }
    //
    //    public function testFindPublishedBySlugAndCategoryNotFoundByCategory(): void
    //    {
    //        $result = $this->articleRepository->findPublishedBySlugAndSection($this->article->slug, 'non-existing-section');
    //        $this->assertNull($result);
    //    }
    //
    //    public function testFindPublishedBySlugAndCategoryNotFoundByStatus(): void
    //    {
    //        $articleDraft = Article::factory()->draft()->create([
    //            'section_id' => $this->section->id,
    //            'slug' => 'slug',
    //        ]);
    //
    //        $result = $this->articleRepository->findPublishedBySlugAndSection($articleDraft->slug, $this->section->slug);
    //        $this->assertNull($result);
    //    }
}
