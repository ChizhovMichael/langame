<?php

namespace App\DataTransfer\Request;

class PostRequest
{
    /** @var string */
    private $title;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $content;

    /** @var array */
    private $category;

    /**
     * @param string $title
     * @param string|null $description
     * @param string|null $content
     * @param array $category
     */
    public function __construct(string $title, ?string $description, ?string $content, array $category = [])
    {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getCategory(): array
    {
        return $this->category;
    }

    /**
     * @param array $category
     */
    public function setCategory(array $category): void
    {
        $this->category = $category;
    }
}
