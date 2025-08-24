<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Services\Similar\SimilarMoviesServiceInterface;
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

        $service = new SimilarMoviesServiceTest($repoMock);

        $dto = $service->getSimilarMovies('Terminator');

        $this->assertInstanceOf(SimilarMovieArticleDTO::class, $dto);
        $this->assertEquals('Similar Movies: Terminator', $dto->title);
        $this->assertCount(2, $dto->movies);
    }
}
