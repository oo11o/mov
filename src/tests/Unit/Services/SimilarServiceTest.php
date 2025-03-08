<?php

namespace Tests\Unit\Services;

use App\DTOs\ArticleDTO;
use App\Enums\ArticleStatusEnum;
use App\Enums\SectionEnum;
use App\Exceptions\Article\SimilarArticleNotFoundException;
use App\Models\Article;
use App\Models\Section;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Services\Similar\SimilarService;
use Mockery;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class SimilarServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->articleRepository = Mockery::mock(ArticleRepositoryInterface::class);
        $this->similarService = new SimilarService($this->articleRepository);
        Section::factory()->createAllSection();
    }

    public function testGetPublishedPostBySlugAndSectionReturnsDto(): void
    {
        $slug = 'slug-article';
        $sectionId = SectionEnum::SIMILAR->value;

        $article = Article::factory()->published()->create(
            [
                'slug' => $slug,
                'section_id' => $sectionId,
            ]
        );

        $this->articleRepository
            ->shouldReceive('findPublishedBySlugAndSection')
            ->with($slug, 'similar')
            ->andReturn($article);

        $dto = $this->similarService->getPublishedArticleBySlug($slug);

        $this->assertInstanceOf(ArticleDTO::class, $dto);

        $this->assertEquals($article->id, $dto->id);
        $this->assertEquals($article->title, $dto->title);
        $this->assertEquals($article->description, $dto->description);
        $this->assertEquals($article->h1, $dto->h1);
        $this->assertEquals($article->intro, $dto->intro);
        $this->assertEquals($article->content, $dto->content);
        $this->assertEquals($article->slug, $dto->slug);
        $this->assertEquals(SectionEnum::from($article->section_id), $dto->section);
        $this->assertEquals(ArticleStatusEnum::from($article->status), $dto->status);
        $this->assertEquals($article->updated_at, $dto->updated_at);
        $this->assertEquals($article->created_at, $dto->created_at);
    }

    /**
     * @throws SimilarArticleNotFoundException
     */
    public function testThrowsExceptionWhenArticleNotFound(): void
    {
        $this->articleRepository
            ->shouldReceive('findPublishedBySlugAndSection')
            ->with('test-slug', 'similar')
            ->andReturn(null);

        $this->expectException(SimilarArticleNotFoundException::class);

        $this->similarService->getPublishedArticleBySlug('test-slug');
    }
}
