<?php

namespace App\DataFactories;

use App\DataTransfer\Rubric;

class RubricFactory
{
    /**
     * @param string $name
     * @param array $parentIds
     * @return Rubric
     */
    public static function make(string $name, array $parentIds = []): Rubric
    {
        return new Rubric($name, $parentIds);
    }
}
