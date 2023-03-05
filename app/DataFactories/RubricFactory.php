<?php

namespace App\DataFactories;

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
}
