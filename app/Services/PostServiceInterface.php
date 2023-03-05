<?php

namespace App\Services;

use App\DataTransfer\Request\PostRequest;
use App\Domain\Post;
use Illuminate\Support\Collection;

interface PostServiceInterface
{
    /**
     * @param PostRequest $post
     * @return void
     */
    public function importPost(PostRequest $post): void;

    /**
     * @param PostRequest $post
     * @return Post
     */
    public function createPost(PostRequest $post): Post;

    /**
     * @return Collection
     */
    public function getRubrics(): Collection;
}
