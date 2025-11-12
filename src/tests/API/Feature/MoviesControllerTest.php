<?php

namespace Tests\api\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MoviesControllerTest extends TestCase
{
    #[Test]
    public function it_publishes_imdb_id_to_queue_and_returns_queued_status(): void
    {
        // $mock = $this->mock(MoviePublisherService::class);

        $apiVersion = env('API_VERSION', 'v1');

        $response = $this->postJson("api/v{$apiVersion}/movies", [
            'imdb_id' => 'tt1234567',
        ]);

        $response->assertStatus(202)
            ->assertJson([
                'status' => 'queued',
                'data' => ['imdb_id' => 'tt1234567'],
            ]);

    }
    //    #[Test]
    //    public function it_returns_validation_error_if_imdb_id_is_invalid(): void
    //    {
    //        $response = $this->postJson('/api/movies', [
    //            'imdb_id' => 'invalid',
    //        ]);
    //
    //        $response->assertStatus(422)
    //            ->assertJsonValidationErrors(['imdb_id']);
    //    }
}
