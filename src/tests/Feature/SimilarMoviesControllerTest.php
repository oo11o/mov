<?php

namespace Tests\Feature;

use App\DTOs\MovieDTO;
use App\DTOs\SimilarMovieArticleDTO;
use App\Exceptions\SimilarMovieNotFoundException;
use App\Services\Similar\SimilarMoviesServiceInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SimilarMoviesControllerTest extends TestCase
{
    #[Test]
    public function it_shows_similar_movies_for_a_given_name(): void
    {
        $this->withoutExceptionHandling();

        $dto = new SimilarMovieArticleDTO(
            title: 'Similar Movies: Terminator',
            h1: 'Top Similar Movies',
            description: 'Description of Terminator movies',
            intro: 'Here are some movies similar to Terminator',
            movies: collect([
                new MovieDto('Robocop', 2014),
                new MovieDto('Terminator 2', 2006),
            ])
        );

        $this->mock(SimilarMoviesServiceInterface::class, function ($mock) use ($dto): void {
            $mock->shouldReceive('getSimilarMovies')
                ->with('Terminator')
                ->andReturn($dto);
        });

        $response = $this->get('/similar/Terminator');

        $response->assertStatus(200);

        $response->assertSee($dto->title);
        $response->assertSee($dto->description);
        $response->assertSee($dto->h1);
        $response->assertSee($dto->intro);

        foreach ($dto->movies as $movie) {
            $response->assertSee($movie->title);
            $response->assertSee($movie->year);
        }
    }

    #[Test]
    public function it_returns_404_if_movie_not_found(): void
    {
        $this->mock(SimilarMoviesServiceInterface::class, function ($mock): void {
            $mock->shouldReceive('getSimilarMovies')
                ->with('UnknownMovie')
                ->andThrow(SimilarMovieNotFoundException::class);
        });

        $response = $this->get('/similar/UnknownMovie');

        $response->assertStatus(404);
    }
}
