<?php

namespace App\Repositories;

use App\Domain\Rubric as RubricDomain;
use Illuminate\Support\Collection;

interface RubricRepositoryInterface
{
    /**
     * @param array $payload
     * @param int|null $parent
     * @return RubricDomain
     */
    public function create(array $payload, ?int $parent = null): RubricDomain;


    /**
     * @param array $expression
     * @param array $columns
     * @return RubricDomain|null
     */
    public function findByColumns(
        array $expression = [],
        array $columns = ['*']
    ): ?RubricDomain;

    /**
     * @param int $postId
     * @param int $rubricId
     * @return void
     */
    public function link(int $postId, int $rubricId): void;

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;
}
