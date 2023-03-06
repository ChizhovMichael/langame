<?php

namespace App\Services;

use App\DataTransfer\Request\PostRequest;
use App\DataTransfer\Request\RubricRequest;
use App\Domain\Post;
use App\Domain\Rubric;
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

    /**
     * @param RubricRequest $rubric
     * @return Rubric
     */
    public function createRubric(RubricRequest $rubric): Rubric;
}
