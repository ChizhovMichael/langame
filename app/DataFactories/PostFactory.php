<?php

namespace App\DataFactories;

use App\DataTransfer\Response\PostRelationship;
use App\DataTransfer\Response\PostResponse;
use App\Domain\Post;
use Illuminate\Support\Collection;

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

    /**
     * @param int $id
     * @param string $title
     * @param string|null $description
     * @param string|null $content
     * @param array $relationshipIds
     * @return PostRelationship
     */
    public static function relationship(
        int $id,
        string $title,
        ?string $description,
        ?string $content,
        array $relationshipIds = []
    ): PostRelationship
    {
        return new PostRelationship($id, $title, $description, $content, $relationshipIds);
    }

    /**
     * @param int $id
     * @param string $title
     * @param string|null $description
     * @param string|null $content
     * @param Collection $rubrics
     * @return PostResponse
     */
    public static function response(
        int $id,
        string $title,
        ?string $description,
        ?string $content,
        Collection $rubrics
    ): PostResponse
    {
        return new PostResponse($id, $title, $description, $content, $rubrics);
    }
}
