<?php

namespace App\DataFactories;

use App\DataTransfer\Post;
use Illuminate\Support\Collection;

class PostFactory
{
    /**
     * @param string $title
     * @param string|null $description
     * @param string|null $content
     * @param Collection $rubrics
     * @return Post
     */
    public static function make(
        string $title,
        ?string $description,
        ?string $content,
        Collection $rubrics
    ): Post
    {
        return new Post($title, $description, $content, $rubrics);
    }
}
