<?php

namespace App\Repositories\Post;

use App\Models\Post;

/**
 * Interface for a post repository.
 * Provides methods to interact with post data storage.
 */
interface PostRepositoryInterface
{
    /**
     * Find a published post by its Slug and SectionName.
     *
     * @param string $slug The slug of the post.
     * @param string $sectionName The name of the section where the post is published.
     * @return Post The post object.
     * @throws PostNotFoundException If no post is found with the given slug and section name.
     */
    public function findPublishedOrFail(string $slug, string $sectionName): Post;
}
