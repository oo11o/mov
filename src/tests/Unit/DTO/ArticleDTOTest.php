<?php

namespace Tests\Unit\DTO;

use App\DTOs\ArticleDTO;
use App\Enums\ArticleStatusEnum;
use App\Enums\SectionEnum;
use App\Models\Article;
use App\Models\Section;
use Carbon\Carbon;
use Tests\TestCase;

class ArticleDTOTest extends TestCase
{
    public function testFromModelCreatesCorrectDTO(): void
    {
        // create article
        $section = Section::factory()->create([
            'id' => 1,
        ]);

        $article = Article::factory()->create([
            'id' => 1,
            'title' => 'Test Title',
            'description' => 'Test Description',
            'h1' => 'Test H1',
            'intro' => 'Test Intro',
            'content' => 'Test Content',
            'slug' => 'test-slug',
            'status' => ArticleStatusEnum::PUBLISHED->value,
            'section_id' => $section->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);

        $dto = ArticleDTO::fromModel($article);

        $this->assertEquals($article->id, $dto->id);
        $this->assertEquals($article->title, $dto->title);
        $this->assertEquals($article->description, $dto->description);
        $this->assertEquals($article->h1, $dto->h1);
        $this->assertEquals($article->intro, $dto->intro);
        $this->assertEquals($article->content, $dto->content);
        $this->assertEquals($article->slug, $dto->slug);
        $this->assertEquals(SectionEnum::from($article->section_id), $dto->section);
        $this->assertEquals(ArticleStatusEnum::from($article->status), $dto->status);
        $this->assertEquals($article->updated_at, $dto->updated_at);
        $this->assertEquals($article->created_at, $dto->created_at);
    }

    public function testArticleDTOCreationThrowsErrorOnInvalidStatus(): void
    {
        $section = Section::factory()->create([
            'id' => 1,
        ]);

        $article = Article::factory()->create([
            'id' => 1,
            'title' => 'Test Title',
            'description' => 'Test Description',
            'h1' => 'Test H1',
            'intro' => 'Test Intro',
            'content' => 'Test Content',
            'slug' => 'test-slug',
            'section_id' => $section->id,
            'status' => 99999,
        ]);

        $this->expectException(\ValueError::class);
        $dto = ArticleDTO::fromModel($article);
    }
}
