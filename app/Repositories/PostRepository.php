<?php

namespace App\Repositories;

use App\DataFactories\PostFactory;
use App\Domain\Post as PostDomain;
use App\Models\Post;
use Illuminate\Support\Collection;

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

    /**
     * @inheritDoc
     */
    public function getPostsWithRelations(array $expression = [], array $columns = ['*'], array $relations = []): Collection
    {
        $posts = $this->model->with($relations)->get($columns);

        return (new Collection($posts))->map(function ($item) {
            $container = $item->relationship;
            $containerIds = null;
            if ($container) {
                $containerIds = $container->pluck('rubric_container_id')->toArray();
            }
            return PostFactory::relationship(
                $item->id,
                $item->title,
                $item->description,
                $item->content,
                $containerIds
            );
        }) ;
    }
}
