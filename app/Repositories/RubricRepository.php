<?php

namespace App\Repositories;

use App\DataFactories\RubricFactory;
use App\Domain\Rubric as RubricDomain;
use App\Models\Rubric;
use Illuminate\Support\Collection;

class RubricRepository implements RubricRepositoryInterface
{
    /** @var Rubric */
    private $model;

    /**
     * @param Rubric $model
     */
    public function __construct(Rubric $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function create(array $payload, array $parents = []): RubricDomain
    {
        $rubric = $this->model->with([])->create($payload);
        if (count($parents)) {
            foreach ($parents as $parent) {
                $rubric->container()->create([
                    'rubric_id' => $rubric->id,
                    'parent_id' => $parent
                ]);
            }
        } else {
            $rubric->container()->create([
                'rubric_id' => $rubric->id,
                'parent_id' => null
            ]);
        }

        return RubricFactory::make(
            $rubric->id,
            $rubric->name
        );
    }

    /**
     * @inheritDoc
     */
    public function findByColumns(
        array $expression = [],
        array $columns = ['*']
    ): ?RubricDomain
    {
        $rubric = $this->model->with([])->select($columns)->where($expression)->first();
        if (!$rubric) return null;

        return RubricFactory::make(
            $rubric->id,
            $rubric->name,
        );
    }

    /**
     * @inheritDoc
     */
    public function link(int $postId, int $rubricId): void
    {
        $rubric = $this->model->with([])->where([
            'id' => $rubricId
        ])->first();
        if (!$rubric) return;
        $containers = $rubric->container->pluck('id')->toArray();
        foreach ($containers as $container) {
            $rubric->relationship()->create([
                'post_id' => $postId,
                'rubric_container_id' => $container
            ]);
        }
    }

    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        $rubrics = $this->model->with($relations)->get($columns);

        return (new Collection($rubrics))->map(function ($item) {
            return RubricFactory::createResponse(
                $item->id,
                $item->name,
                $item->container->first()->parent_id
            );
        }) ;
    }
}
