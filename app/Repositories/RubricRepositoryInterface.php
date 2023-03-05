<?php

namespace App\Repositories;

use App\DataTransfer\Rubric;
use App\DataTransfer\Rubric as RubricDataTransfer;

interface RubricRepositoryInterface
{
    /**
     * @param array $payload
     * @param array $parents
     * @return int
     */
    public function create(array $payload, array $parents = []): int;


    /**
     * @param array $expression
     * @param array $columns
     * @return RubricDataTransfer|null
     */
    public function findByColumns(
        array $expression = [],
        array $columns = ['*']
    ): ?RubricDataTransfer;

    /**
     * @param int $postId
     * @param RubricDataTransfer $rubric
     * @return void
     */
    public function link(int $postId, Rubric $rubric): void;
}
