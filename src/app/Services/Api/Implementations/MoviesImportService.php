<?php

namespace App\Services\Api\Implementations;

use App\DTOs\Api\MovieImportResultDTO;
use App\Jobs\MovieImportJob;
use App\Services\Api\Contracts\MoviesImportInterface;
use Illuminate\Support\Facades\Log;

/**
 * Class MoviesImportService
 *
 * Handles queuing movies for import by IMDb IDs.
 * This service dispatches a job for each IMDb ID to the queue for processing.
 */
class MoviesImportService implements MoviesImportInterface
{
    /**
     * Enqueue movies for import by IMDb IDs.
     *
     * @param array $imdbIds List of IMDb IDs to be queued for import.
     * @return array Associative array containing successfully queued and failed IMDb IDs.
     */
    public function enqueueImportMovies(array $imdbIds): MovieImportResultDTO
    {
        $uniqueIds = array_unique($imdbIds);
        $queued = [];
        $failed = [];

        foreach ($uniqueIds as $imdbId) {
            try {
                MovieImportJob::dispatch($imdbId);
                $queued[] = $imdbId;
            } catch (\Exception $e) {
                Log::error("Failed to dispatch job for IMDb ID: $imdbId", ['exception' => $e]);
                $failed[] = $imdbId;
            }
        }

        return new MovieImportResultDTO($queued, $failed);
    }
}
