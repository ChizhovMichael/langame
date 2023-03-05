<?php

namespace App\Repositories;

use App\Domain\Rubric as RubricDomain;

interface RubricRepositoryInterface
{
    /**
     * @param array $payload
     * @param array $parents
     * @return void
     */
    public function create(array $payload, array $parents = []): RubricDomain;


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
}
