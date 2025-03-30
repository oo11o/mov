<?php

use App\DTOs\Api\MovieImportResultDTO;
use App\Jobs\MovieImportJob;
use App\Services\Api\Implementations\MoviesImportService;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class MoviesImportServiceTest extends TestCase
{
    public function testEnqueueImportMoviesAllQueued(): void
    {
        Queue::fake();

        $service = new MoviesImportService();
        $imdbIds = ['tt1234567', 'tt7654321', 'tt1234517'];

        $result = $service->enqueueImportMovies($imdbIds);

        Queue::assertPushed(MovieImportJob::class, 3);

        $this->assertInstanceOf(MovieImportResultDTO::class, $result);
        $this->assertCount(3, $result->queued);
        $this->assertCount(0, $result->failed);
        $this->assertEquals($imdbIds, $result->queued);
    }

    public function testEnqueueImportMoviesAllFailed(): void
    {
        Queue::fake();
        Queue::shouldReceive('push')->andThrow(new \Exception('Queue error'));

        $service = new MoviesImportService();
        $imdbIds = ['tt1234567', 'tt7654321', 'tt9876543'];

        $result = $service->enqueueImportMovies($imdbIds);

        $this->assertInstanceOf(MovieImportResultDTO::class, $result);
        $this->assertEmpty($result->queued);
        $this->assertEquals($imdbIds, $result->failed);
    }

    //    public function testEnqueueImportMoviesPartialQueuedPartialFailed()
    //    {
    //        Queue::fake();
    //
    //        $service = new MoviesImportService();
    //        $imdbIds = ['tt1234567', 'tt7654321', 'tt9876543'];
    //
    //
    //        Queue::shouldReceive('push')
    //            ->once()
    //            ->andThrow(new \Exception('Queue error'));
    //
    //
    //        $result = $service->enqueueImportMovies($imdbIds);
    //
    //        $this->assertInstanceOf(MovieImportResultDTO::class, $result);
    //        $this->assertCount(2, $result->queued);
    //        $this->assertCount(1, $result->failed);
    //        $this->assertEquals(['tt7654321'], $result->failed);
    //        $this->assertEqualsCanonicalizing(['tt1234567', 'tt9876543'], $result->queued);
    //    }
}
