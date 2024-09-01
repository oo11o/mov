<?php

namespace Tests\Feature\Services;

use App\DTOs\ArticleDTO;
use App\Enums\ArticleStatusEnum;
use App\Enums\SectionEnum;
use App\Exceptions\Article\SimilarArticleNotFoundException;
use App\Models\Article;
use App\Models\Section;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Services\Similar\SimilarService;
use Tests\TestCase;

class SimilarServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $articleRepository = app(ArticleRepositoryInterface::class);
        $this->similarService = new SimilarService($articleRepository);

        Section::factory()->createAllSection();

        $this->slug = 'slug-exist-article';
        $this->article = Article::factory()->published()->create(
            [
                'slug' => $this->slug,
                'section_id' => SectionEnum::SIMILAR->value,
            ]
        );

    }

    public function testGetPublishedPostBySlugAndSectionReturnsDto(): void
    {

        $dto = $this->similarService->getPublishedPostBySlugAndSection($this->slug);

        $this->assertInstanceOf(ArticleDTO::class, $dto);

        $this->assertEquals($this->article->id, $dto->id);
        $this->assertEquals($this->article->title, $dto->title);
        $this->assertEquals($this->article->description, $dto->description);
        $this->assertEquals($this->article->h1, $dto->h1);
        $this->assertEquals($this->article->intro, $dto->intro);
        $this->assertEquals($this->article->content, $dto->content);
        $this->assertEquals($this->article->slug, $dto->slug);
        $this->assertEquals(SectionEnum::from($this->article->section_id), $dto->section);
        $this->assertEquals(ArticleStatusEnum::from($this->article->status), $dto->status);
        $this->assertEquals($this->article->updated_at, $dto->updated_at);
        $this->assertEquals($this->article->created_at, $dto->created_at);
    }

    /**
     * @throws SimilarArticleNotFoundException
     */
    public function testThrowsExceptionWhenArticleNotFound(): void
    {
        $this->expectException(SimilarArticleNotFoundException::class);
        $this->similarService->getPublishedPostBySlugAndSection('test-slug');
    }
}
