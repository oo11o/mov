<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\DTOs\MovieDTO;
use App\Repositories\SimilarMoviesRepositoryInterface;
use App\Services\Similar\SimilarMoviesService;
use App\DTOs\SimilarMovieArticleDTO;
use App\Exceptions\SimilarMovieNotFoundException;

class SimilarMoviesServiceTest extends TestCase
{
    #[Test]
    public function it_returns_dto_with_similar_movies(): void
    {
        $repoMock = $this->mock(SimilarMoviesRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('findSimilarMovies')
                ->with('Terminator')
                ->andReturn(collect([
                    new MovieDto('Robocop', 2014),
                    new MovieDto('Terminator 2', 2006),
                ]));
        });

        $service = new SimilarMoviesService($repoMock);

        $dto = $service->getSimilarMovies('Terminator');

        $this->assertInstanceOf(SimilarMovieArticleDTO::class, $dto);
        $this->assertEquals('Similar Movies: Terminator', $dto->title);
        $this->assertCount(2, $dto->movies);
    }

    #[Test]
    public function it_throws_exception_when_similar_movies_are_not_found(): void
    {
        $repoMock = $this->mock(SimilarMoviesRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('findSimilarMovies')
                ->with('Unknown')
                ->andReturn([]);
        });

        $this->expectException(SimilarMovieNotFoundException::class);

        $service = new SimilarMoviesService($repoMock);
        $service->getSimilarMovies('Unknown');
    }

}
