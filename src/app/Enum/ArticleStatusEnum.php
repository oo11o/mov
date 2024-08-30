<?php

namespace App\Enum;

use App\Exceptions\Enum\ArticleStatusEnumInvalidException;

/**
 * Represents the status of a post.
 */
enum ArticleStatusEnum: int
{
    case DRAFT = 0;
    case PUBLISHED = 1;

    /**
     * Get the enum instance from an integer value.
     *
     * @param int $value
     * @return self
     * @throws ArticleStatusEnumInvalidException
     */
    public static function fromValue(int $value): self
    {
        return match($value) {
            self::DRAFT->value => self::DRAFT,
            self::PUBLISHED->value => self::PUBLISHED,
            default => throw new ArticleStatusEnumInvalidException("Invalid value for ArticleStatusEnum: $value"),
        };
    }

    /**
     * Return all values
     *
     * @return array
     */
    public static function getAllValues(): array
    {
        return array_map(static fn($case) => $case->value, self::cases());
    }
}
