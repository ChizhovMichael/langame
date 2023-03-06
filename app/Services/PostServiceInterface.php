<?php

namespace App\Services;

use App\DataTransfer\Request\PostRequest;
use App\DataTransfer\Request\RubricRequest;
use App\DataTransfer\Response\PostResponse;
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
     * @return PostResponse
     */
    public function createPost(PostRequest $post): PostResponse;

    /**
     * @return Collection
     */
    public function getRubrics(): Collection;

    /**
     * @param RubricRequest $rubric
     * @return Rubric
     */
    public function createRubric(RubricRequest $rubric): Rubric;

    /**
     * @param string|null $search
     * @return Collection
     */
    public function getPosts(?string $search = null): Collection;
}
