<?php

namespace Database\Factories;

use App\Models\Section;
use App\Enums\SectionEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $randomSectionEnumCase = $this->faker->randomElement(SectionEnum::cases());

        return [
            'id' => $randomSectionEnumCase->value,
            'name' => strtolower($randomSectionEnumCase->name),
            'slug' => strtolower($randomSectionEnumCase->name),
        ];
    }

    public function createSimilarSection(): self
    {
        return $this->state(fn() => [
            'id' => 1,
            'name' => 'similar',
            'slug' => 'similar',
        ]);
    }

    /**
     * Create a database record for each case in the SectionEnum.
     *
     * @return self
    */
    public function createAllSection(): self
    {
        $cases = SectionEnum::cases();

        foreach ($cases as $case) {
            $name = strtolower($case->name);
            Section::factory()->create([
                'id' => $case->value,
                'name' => $name,
                'slug' => $name,
            ]);
        }

        return $this;
    }
}
