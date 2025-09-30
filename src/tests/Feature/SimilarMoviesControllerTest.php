<?php

namespace Tests\Feature;

use App\Exceptions\SimilarMovieNotFoundException;
use App\Models\Article;
use App\Models\Movie;
use App\Models\Section;
use App\Services\Similar\SimilarMoviesService;
use App\Services\Similar\SimilarMoviesServiceInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SimilarMoviesControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        //$this->SimilarMoviesService = new SimilarMoviesService();

        // create article
        $this->section = Section::factory()->createSimilarSection()->create();
        $this->article = Article::factory()->published()->create([
            'section_id' => $this->section->id,
            'slug' => 'Terminator',
            'title' => 'Article Test Title',
            'description' => 'Article Test Description',
        ]);

        $this->movies = Movie::factory()->count(10)->create();
        $this->article->movies()->attach($this->movies->pluck('id'));
    }

    #[Test]
    public function it_shows_similar_movies_for_a_given_name(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/similar/Terminator');

        $response->assertSee('Article Test Title');
        $response->assertSee('Article Test Description');

        foreach ($this->article->movies as $movie) {
            $response->assertSee($movie->title);
            $response->assertSee($movie->year);
        }

        $response->assertStatus(200);

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
