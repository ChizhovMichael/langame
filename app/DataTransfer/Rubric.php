<?php

namespace App\DataTransfer;

class Rubric
{
    /** @var string */
    private $name;

    /** @var array */
    private $parentIds;

    /**
     * @param string $name
     * @param array $parentIds
     */
    public function __construct(string $name, array $parentIds = [])
    {
        $this->name = $name;
        $this->parentIds = $parentIds;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getParentIds(): array
    {
        return $this->parentIds;
    }
}
