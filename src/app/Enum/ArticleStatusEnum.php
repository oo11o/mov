<?php

namespace App\Enum;

/**
 * Represents the status of a post.
 */
enum ArticleStatusEnum: int
{
    case DRAFT = 0;
    case PUBLISHED = 1;
}
