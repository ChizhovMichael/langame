<?php

namespace App\Repositories;

use App\DataFactories\RubricFactory;
use App\DataTransfer\Rubric as RubricDataTransfer;
use App\Models\Rubric;

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
    public function create(array $payload, array $parents = []): int
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

        return $rubric->id;
    }

    /**
     * @inheritDoc
     */
    public function findByColumns(
        array $expression = [],
        array $columns = ['*']
    ): ?RubricDataTransfer
    {
        $rubric = $this->model->with([])->select($columns)->where($expression)->first();
        if (!$rubric) {
            return null;
        }

        return RubricFactory::make(
            $rubric->name,
            $rubric->container->pluck('parent_id')->toArray()
        );
    }

    /**
     * @inheritDoc
     */
    public function link(int $postId, RubricDataTransfer $rubric): void
    {
        $rubric = $this->model->with([])->where([
            'name' => $rubric->getName()
        ])->first();
        if ($rubric) {
            $containers = $rubric->container->pluck('id')->toArray();

            foreach ($containers as $container) {
                $rubric->relationship()->create([
                    'post_id' => $postId,
                    'rubric_container_id' => $container
                ]);
            }
        }
    }
}
