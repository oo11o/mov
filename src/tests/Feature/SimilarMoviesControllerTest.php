<?php

namespace Tests\Feature;

use App\Services\Similar\SimilarMoviesServiceInterface;
use PHPUnit\Framework\Attributes\Test;
use App\DTOs\MovieDTO;
use Tests\TestCase;

class SimilarMoviesControllerTest extends TestCase
{
    #[Test]
    public function it_shows_similar_movies_for_a_given_name(): void
    {
        $this->withoutExceptionHandling();

        $this->mock(SimilarMoviesServiceInterface::class, function ($mock) {
            $mock->shouldReceive('getSimilarMovies')
                ->with('Terminator')
                ->andReturn(
                    new SimilarMovieArtircleDTO(
                        title: 'Similar Movies: Terminator',
                        description: 'Description of Terminator movies',
                        h1: 'Top Similar Movies',
                        intro: 'Here are some movies similar to Terminator',
                        movies: collect([
                            new MovieDto('Robocop', 2014),
                            new MovieDto('Terminator 2', 2006),
                        ])
                    )
                );
        });

        $response = $this->get('/similar/Terminator');

        $response->assertSee('Similar Movies: Terminator');
        $response->assertSee('Description of Terminator movies');
        $response->assertSee('Top Similar Movies');
        $response->assertSee('Here are some movies similar to Terminator');

        $response->assertStatus(200);
        $response->assertSee('Robocop');
        $response->assertSee('Terminator 2');
    }
}
