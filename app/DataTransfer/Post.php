<?php

namespace App\DataTransfer;

class Post
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
    public function __construct(string $title, ?string $description, ?string $content, array $category)
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
    public function getCategory(): array
    {
        return $this->category;
    }
}
