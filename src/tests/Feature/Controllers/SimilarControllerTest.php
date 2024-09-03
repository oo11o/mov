<?php

namespace Tests\Feature\Controllers;

use App\Enums\SectionEnum;
use App\Models\Article;
use App\Models\Section;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SimilarControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->slug = 'valid-slug';
        Section::factory()->createAllSection();

        $this->articles = Article::factory()->count(4)->create();
        $this->articles->push(
            Article::factory()->published()->create([
                'slug' => $this->slug,
                'section_id' => SectionEnum::SIMILAR->value,
            ])
        );
    }
    #[Test]
    public function show_article_by_slug(): void
    {

        $article = $this->articles
            ->first(fn($item) => $item->slug === $this->slug);

        $this
            ->get('/similar/' . $this->slug)
            ->assertDontSee('null', false)
            ->assertSee(
                [
                    $article->intro,
                    $article->h1,
                    $article->content,
                ]
            )
            ->assertSuccessful();
    }

    #[Test]
    public function show_404_for_non_exist_article(): void
    {
        $this
            ->get('/similar/' . 'no-article')
            ->assertNotFound();
    }

    #[Test]
    public function show_404_for_invalid_slug_exist(): void
    {
        $this
            ->get('/similar/' . 'no article %%%  23333333333333333333333333333333333333333333333333333333333333333')
            ->assertNotFound();
    }
}
