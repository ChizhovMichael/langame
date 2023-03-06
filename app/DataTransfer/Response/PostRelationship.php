<?php

namespace App\DataTransfer\Response;

class PostRelationship
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $content;

    /** @var array */
    private $relationshipIds;

    /**
     * @param int $id
     * @param string $title
     * @param string|null $description
     * @param string|null $content
     * @param array $relationshipIds
     */
    public function __construct(int $id, string $title, ?string $description, ?string $content, array $relationshipIds = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->relationshipIds = $relationshipIds;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function getRelationshipIds(): array
    {
        return $this->relationshipIds;
    }
}
