<?php

namespace App\Enum;

/**
 * Represents the status of a post.
 */
enum PostStatusEnum: int
{
    case DRAFT = 0;
    case PUBLISHED = 1;
}
