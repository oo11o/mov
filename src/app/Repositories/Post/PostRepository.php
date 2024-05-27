<?php

namespace App\Repositories\Post;

use App\Enum\PostStatusEnum;
use App\Models\Post;

/*
 * Class for managing post data in a database.
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findPublishedOrFail(string $slug, string $sectionName): Post
    {
        dump($slug);
        dump($sectionName);

        return Post::where('slug', $slug)
            ->where('status', PostStatusEnum::PUBLISHED)
            ->whereHas('section', function ($query) use ($sectionName): void {
                $query->where('slug', $sectionName);
            })
            ->firstOrFail();
    }
}
