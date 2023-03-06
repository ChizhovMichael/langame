<?php

namespace App\DataTransfer\Request;

class RubricRequest
{
    /** @var string */
    private $name;

    /** @var int|null */
    private $parent;

    /**
     * @param string $name
     * @param int|null $parent
     */
    public function __construct(string $name, ?int $parent)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getParent(): ?int
    {
        return $this->parent;
    }
}
