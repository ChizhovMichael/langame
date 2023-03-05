<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    /** @var Post */
    private $model;

    /**
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function create(array $payload): int
    {
        $post = $this->model->with([])->create($payload);

        return $post->id;
    }
}
