<?php

namespace App\Services;

use App\DataTransfer\Post;

interface PostServiceInterface
{
    /**
     * @param Post $post
     * @return void
     */
    public function importPost(Post $post): void;
}
