<?php

namespace App\Traits;

trait EnumHelper
{
    /**
     * Return all values
     *
     * @return array
     */
    public static function getAllValues(): array
    {
        return array_map(static fn ($case) => $case->value, self::cases());
    }
}
