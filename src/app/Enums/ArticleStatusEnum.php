<?php

namespace App\Enums;

use App\Traits\EnumHelper;

/**
 * Represents the status of a post.
 */
enum ArticleStatusEnum: int
{
    use EnumHelper;

    case DRAFT = 0;
    case PUBLISHED = 1;

}
