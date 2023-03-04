<?php

namespace App\DataFactories;

use App\DataTransfer\Post;
use Illuminate\Support\Collection;

class PostFactory
{
    /**
     * @param array $posts
     * @return Collection
     */
    public static function collection(array $posts): Collection
    {
        return (new Collection($posts))->map(function ($post) {
            return static::make($post);
        });
    }

    /**
     * @param array $attributes
     * @return Post
     */
    public static function make(array $attributes): Post
    {
        return new Post(
            $attributes['title'],
            $attributes['description'],
            $attributes['content'],
            $attributes['category']
        );
    }
}
