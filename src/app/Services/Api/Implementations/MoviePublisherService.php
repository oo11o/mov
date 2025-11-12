<?php

namespace App\Services\Api\Implementations;

use App\Services\Api\Contracts\MoviePublisherServiceInterface;

class MoviePublisherService implements MoviePublisherServiceInterface
{
    public function publish(string $imdbId): array
    {
        return [
            'status' => 'queued',
            'data' => ['imdb_id' => $imdbId],
        ];
    }

    public function getStatus(string $imdbId): string
    {

    }
}
