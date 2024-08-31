<?php

namespace Tests\Unit\ENUM;

use App\Enums\SectionEnum;
use Tests\TestCase;

class SectionEnumTest extends TestCase
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
            array_map(static fn ($case) => $case->value, SectionEnum::cases()),
            SectionEnum::cases()
        );
    }

    public function testValidEnumConversion(): void
    {
        foreach ($this->statusCases as $value => $enum) {
            $this->assertSame($enum, SectionEnum::from($value));
        }
    }

    public function testInvalidEnumConversion(): void
    {
        $this->expectException(\ValueError::class);
        SectionEnum::from(9999); // Test an invalid value
    }

    public function testGetValues(): void
    {
        $expectedValues = array_keys($this->statusCases);
        $this->assertSame($expectedValues, SectionEnum::getAllValues());
    }
}
