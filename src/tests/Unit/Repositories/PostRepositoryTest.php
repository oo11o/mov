<?php

namespace Tests\Unit\Repositories;

use App\Models\Post;
use App\Models\Section;
use App\Repositories\Post\PostRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepository = new PostRepository();

        // create post
        $this->section = Section::factory()->createSimilarSection()->create();
        $this->post = Post::factory()->published()->create([
            'section_id' => $this->section->id,
            'slug' => 'some_slug',
        ]);
    }

    public function testFoundPostBySlugAndSection(): void
    {
        $foundPost = $this->postRepository->findPublishedOrFail($this->post->slug, $this->section->slug);

        $this->assertNotNull($foundPost);
        $this->assertEquals($this->post->toArray(), $foundPost->toArray());
        $this->assertDatabaseCount('posts', 1);
    }

    public function testNotFoundPostByFailSlug(): void
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $this->postRepository->findPublishedOrFail('fail_slug', $this->section->slug);
    }

    public function testNotFoundPostByFailSection(): void
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $this->postRepository->findPublishedOrFail($this->post->slug, 'fail_section');
    }

    public function testNotFoundDraftPost(): void
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $postDraft = Post::factory()->draft()->create([
            'section_id' => $this->section->id,
            'slug' => 'slug',
        ]);

        $this->postRepository->findPublishedOrFail($postDraft->slug, $this->section->slug);
    }
}
