<?php

namespace App\Repositories;

use App\DataFactories\RubricFactory;
use App\DataTransfer\Response\RubricResponse;
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
    public function create(array $payload, ?int $parent = null): RubricDomain
    {
        $rubric = $this->model->with([])->create($payload);
        $rubric->container()->create([
            'rubric_id' => $rubric->id,
            'parent_id' => $parent
        ]);

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

    /**
     * @param int $relationshipId
     * @return RubricResponse
     */
    public function getRubricByRelationship(int $relationshipId): RubricResponse
    {
        $rubric = $this->model->whereHas('container', function($q) use ($relationshipId) {
            $q->where('id', '=', $relationshipId);
        })->first();

        return RubricFactory::createResponse(
            $rubric->id,
            $rubric->name,
            $rubric->container->first()->parent_id
        );
    }
}
