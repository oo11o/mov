<?php

namespace App\DTO;

readonly class PostDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public string $h1,
        public string $intro,
        public string $content,
        public string $slug,
        public string $status,
    ) {}
}
