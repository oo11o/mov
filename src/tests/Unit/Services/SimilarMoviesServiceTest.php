<?php

namespace Tests\Unit\Services;

use App\DTOs\SimilarMovieArticleDTO;
use App\Exceptions\SimilarMovieNotFoundException;
use App\Models\Section;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\SimilarMoviesRepositoryInterface;
use App\Services\Similar\SimilarMoviesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\Article;
use App\Models\Movie;

class SimilarMoviesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->articleRepository = new ArticleRepository();

        // create article
        $this->section = Section::factory()->createSimilarSection()->create();
        $this->article = Article::factory()->published()->create([
            'section_id' => $this->section->id,
            'slug' => 'Terminator',
            'title' => 'Article Test Title',
        ]);

        $this->movies = Movie::factory()->count(10)->create();
        $this->article->movies()->attach($this->movies->pluck('id'));
    }

    #[Test]
    public function it_returns_dto_with_similar_movies(): void
    {
        $service = new SimilarMoviesService($this->articleRepository);

        $dto = $service->getSimilarMovies($this->article->slug);

        $this->assertInstanceOf(SimilarMovieArticleDTO::class, $dto);
        $this->assertEquals($this->article->title, $dto->title);
        $this->assertCount(10, $dto->movies);
    }

    #[Test]
    public function it_throws_exception_when_similar_movies_are_not_found(): void
    {
        $this->expectException(SimilarMovieNotFoundException::class);
        $service = new SimilarMoviesService($this->articleRepository);
        $service->getSimilarMovies('Unknown');
    }
}
