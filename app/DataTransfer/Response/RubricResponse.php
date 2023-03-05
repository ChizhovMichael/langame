<?php

namespace App\DataTransfer\Response;

class RubricResponse
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var int|null */
    private $parentId;

    /**
     * @param int $id
     * @param string $name
     * @param int|null $parentId
     */
    public function __construct(int $id, string $name, ?int $parentId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getParentId(): ?int
    {
        return $this->parentId;
    }
}
