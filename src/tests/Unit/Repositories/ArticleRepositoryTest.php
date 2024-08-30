<?php

namespace Tests\Unit\Repositories;

use App\Models\Article;
use App\Models\Section;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            'slug' => 'some_slug',
        ]);
    }

    public function testFindArticleBySlugAndSection(): void
    {
        $foundPost = $this->articleRepository->findPublishedOrFail($this->article->slug, $this->section->slug);

        $this->assertNotNull($foundPost);
        $this->assertEquals($this->article->toArray(), $foundPost->toArray());
        $this->assertDatabaseCount('articles', 1);
    }

    public function testNotFindPostByFailSlug(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->articleRepository->findPublishedOrFail('fail_slug', $this->section->slug);
    }

    public function testNotFoundPostByFailSection(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->articleRepository->findPublishedOrFail($this->article->slug, 'fail_section');
    }

    public function testNotFoundDraftPost(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $articleDraft = Article::factory()->draft()->create([
            'section_id' => $this->section->id,
            'slug' => 'slug',
        ]);

        $this->articleRepository->findPublishedOrFail($articleDraft->slug, $this->section->slug);
    }
}
