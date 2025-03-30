<?php

namespace App\DTOs\Api;

class MovieImportResultDTO
{
    public array $queued;
    public array $failed;

    public function __construct(array $queued, array $failed)
    {
        $this->queued = $queued;
        $this->failed = $failed;
    }

    public function toArray(): array
    {
        return [
            'queued' => $this->queued,
            'failed' => $this->failed,
        ];
    }
}
