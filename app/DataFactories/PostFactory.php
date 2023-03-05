<?php

namespace App\DataFactories;

use App\Domain\Post;

class PostFactory
{
    /**
     * @param int|null $id
     * @param string $title
     * @param string|null $description
     * @param string|null $content
     * @return Post
     */
    public static function make(
        ?int $id,
        string $title,
        ?string $description,
        ?string $content
    ): Post
    {
        return new Post($id, $title, $description, $content);
    }
}
