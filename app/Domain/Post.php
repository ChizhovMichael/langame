<?php

namespace App\Domain;

class Post
{
    /** @var int|null */
    private $id;

    /** @var string */
    private $title;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $content;

    /**
     * @param int|null $id
     * @param string $title
     * @param string|null $description
     * @param string|null $content
     */
    public function __construct(?int $id, string $title, ?string $description, ?string $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
