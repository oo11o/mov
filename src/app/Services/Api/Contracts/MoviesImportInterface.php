<?php

namespace App\Services\Api\Contracts;

use App\DTOs\Api\MovieImportResultDTO;

/**
 * Interface MoviesImportInterface
 *
 * Defines the contract for queuing movie imports by IMDb IDs.
 */
interface MoviesImportInterface
{
    /**
     * Enqueue movies for import by IMDb IDs.
     *
     * @param array $imdbIds The list of IMDb IDs to be queued for import.
     * @return array An associative array with 'queued' (successfully added) and 'failed' (failed to enqueue) IMDb IDs.
     */
    public function enqueueImportMovies(array $imdbIds): MovieImportResultDTO;
}
