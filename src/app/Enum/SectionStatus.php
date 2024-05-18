<?php

namespace App\Enum;

/**
 * Represents the status of a section.
 */
enum SectionStatus: int
{
    case DRAFT = 0;
    case PUBLISHED = 1;
}
