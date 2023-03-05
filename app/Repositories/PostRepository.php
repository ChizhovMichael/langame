<?php

namespace App\Repositories;

use App\DataFactories\PostFactory;
use App\Domain\Post as PostDomain;
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
    public function create(array $payload): PostDomain
    {
        $post = $this->model->with([])->create($payload);

        return PostFactory::make(
            $post->id,
            $post->title,
            $post->description,
            $post->content
        );
    }
}
