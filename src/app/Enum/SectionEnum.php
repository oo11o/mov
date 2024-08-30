<?php

namespace App\Enum;

use App\Exceptions\Enum\SectionEnumInvalidException;

/**
 * Enumeration representing different sections.
 */
enum SectionEnum: int
{
    case SIMILAR = 1;
    case LIST = 2;

    /**
     * Get the enum instance from an integer value.
     *
     * @param int $value
     * @return self
     * @throws SectionEnumInvalidException
     */
    public static function fromValue(int $value): self
    {
        return match($value) {
            self::SIMILAR->value => self::SIMILAR,
            self::LIST->value => self::LIST,
            default => throw new SectionEnumInvalidException("Invalid value for ArticleStatusEnum: $value"),
        };
    }

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
