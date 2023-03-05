<?php

namespace App\DataTransfer;

use Illuminate\Support\Collection;

class Post
{
    /** @var string */
    private $title;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $content;

    /** @var Collection */
    private $rubrics;

    /**
     * @param string $title
     * @param string|null $description
     * @param string|null $content
     * @param Collection $rubrics
     */
    public function __construct(string $title, ?string $description, ?string $content, Collection $rubrics)
    {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->rubrics = $rubrics;
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
     * @return Collection
     */
    public function getRubrics(): Collection
    {
        return $this->rubrics;
    }
}
