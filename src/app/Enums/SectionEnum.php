<?php

namespace App\Enums;

use App\Traits\EnumHelper;

/**
 * Enumeration representing different sections.
 */
enum SectionEnum: int
{
    use EnumHelper;

    case SIMILAR = 1;
    case LIST = 2;
}
