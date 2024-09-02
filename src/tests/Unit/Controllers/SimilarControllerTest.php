<?php

namespace Tests\Unit\Controllers;
use App\Enums\SectionEnum;
use App\Exceptions\Article\SimilarArticleNotFoundException;
use App\Http\Controllers\SimilarController;
use App\Models\Article;
use App\Models\Section;
use App\Services\Similar\SimilarService;
use App\DTOs\ArticleDTO;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Mockery;

class SimilarControllerTest extends TestCase
{
    protected SimilarService $similarServiceMock;
    protected SimilarController $similarController;
    protected string $slug;
    protected Article $article;

    protected function setUp(): void
    {
        parent::setUp();
        $this->similarServiceMock =  Mockery::mock(SimilarService::class);
        $this->similarController = new SimilarController($this->similarServiceMock);
        $this->slug = 'valid-slug';

        Section::factory()->createAllSection();

        $this->article = Article::factory()->published()->create(
            [
                'slug' => $this->slug,
                'section_id' => SectionEnum::SIMILAR->value,
            ]
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @throws SimilarArticleNotFoundException
     */
    #[Test]
    public function show_article_by_slug_successful(): void
    {
        $articleDTO = ArticleDTO::fromModel($this->article);

        $this->similarServiceMock
            ->shouldReceive('getPublishedPostBySlug')
            ->with($this->slug)
            ->andReturn($articleDTO);
        $this->withoutExceptionHandling();
        $response = $this->similarController->show($this->slug);

        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * @throws SimilarArticleNotFoundException
     */
    #[Test]
    public function show_invalid_slug_fails_return_404(): void
    {
        $invalidSlug = 'invalid slug';

        Log::shouldReceive('error')
            ->once()
            ->with(Mockery::pattern('/^Validation error for slug: ' . $invalidSlug .'/'));

        $this->expectException(NotFoundHttpException::class);
        $this->similarController->show($invalidSlug);
    }


    /**
     * @throws SimilarArticleNotFoundException
     */
    #[Test]
    public function show_no_found_article_return_404(): void
    {
        $this->similarServiceMock
            ->shouldReceive('getPublishedPostBySlug')
            ->with($this->slug)
            ->andThrow(SimilarArticleNotFoundException::class);

        Log::shouldReceive('warning')
            ->once()
            ->with(Mockery::pattern('/^Similar article not found by slug: ' . $this->slug .'/'));

       $this->expectException(NotFoundHttpException::class);
        $this->similarController->show($this->slug);

    }

    /**
     * @throws SimilarArticleNotFoundException
     */
    #[Test]
    public function show_unexpected_error_occurred_404(): void
    {
        $this->similarServiceMock
            ->shouldReceive('getPublishedPostBySlug')
            ->with($this->slug)
            ->andThrow(\UnexpectedValueException::class);

        Log::shouldReceive('error')
            ->once()
            ->with(Mockery::pattern('/^An unexpected error occurred/'));

        $this->expectException(NotFoundHttpException::class);

        $this->similarController->show($this->slug);

    }
}
