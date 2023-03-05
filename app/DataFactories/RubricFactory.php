<?php

namespace App\DataFactories;

use App\DataTransfer\Response\RubricResponse;
use App\Domain\Rubric;

class RubricFactory
{
    /**
     * @param int|null $id
     * @param string $name
     * @return Rubric
     */
    public static function make(?int $id, string $name): Rubric
    {
        return new Rubric($id, $name);
    }

    /**
     * @param int $id
     * @param string $name
     * @param int|null $parent_id
     * @return RubricResponse
     */
    public static function createResponse(int $id, string $name, ?int $parent_id = null): RubricResponse
    {
        return new RubricResponse($id, $name, $parent_id);
    }
}
