<?php

namespace Tests\Unit\ENUM;

use App\Enum\ArticleStatusEnum;
use App\Exceptions\Enum\ArticleStatusEnumInvalidException;
use Tests\TestCase;

class ArticleStatusEnumTest extends TestCase
{
    private array $statusCases;

    protected function setUp(): void
    {
        parent::setUp();
        $this->statusCases = $this->getStatusCases();
    }

    /**
     * Get all status cases from the enum.
     *
     * @return array
     */
    private function getStatusCases(): array
    {
        return array_combine(
            array_map(static fn ($case) => $case->value, ArticleStatusEnum::cases()),
            ArticleStatusEnum::cases()
        );
    }

    /**
     * @throws ArticleStatusEnumInvalidException
     */
    public function testValidEnumConversion(): void
    {
        foreach ($this->statusCases as $value => $enum) {
            $this->assertSame($enum, ArticleStatusEnum::fromValue($value));
        }
    }

    /**
     * @throws ArticleStatusEnumInvalidException
     */
    public function testInvalidEnumConversion(): void
    {
        $this->expectException(ArticleStatusEnumInvalidException::class);
        ArticleStatusEnum::fromValue(999); // Test an invalid value
    }

    public function testGetValues(): void
    {
        $expectedValues = array_keys($this->statusCases);
        $this->assertSame($expectedValues, ArticleStatusEnum::getAllValues());
    }
}
