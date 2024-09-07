<?php

namespace Database\Seeders;

use App\Enums\ArticleStatusEnum;
use App\Enums\SectionEnum;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Article::factory(10)->create();
        \App\Models\Article::factory()->create([
            'slug' => 'similar-slug-test',
            'title' => 'similar-title-test',
            'description' => 'similar-description-test',
            'h1' => 'similar-h1-test',
            'content' => '<p>content-test</p>',
            'status' => ArticleStatusEnum::PUBLISHED->value,
            'section_id' => SectionEnum::SIMILAR->value,
        ]);
    }
}
