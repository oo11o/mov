<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::factory()
            ->count(2)
            ->sequence(
                [
                    'id' => '1',
                    'name' => 'Similar Section',
                    'slug' => 'similar',
                ],
                [
                    'id' => '2',
                    'name' => 'List Section',
                    'slug' => 'list',
                ]
            )
            ->create();
    }
}
