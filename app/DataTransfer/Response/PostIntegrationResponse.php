<?php

namespace App\DataTransfer\Response;

use Illuminate\Support\Collection;

class PostIntegrationResponse
{
    /** @var Collection */
    private $posts;

    /** @var string */
    private $nexPage;

    /**
     * @param Collection $posts
     * @param string $nexPage
     */
    public function __construct(Collection $posts, string $nexPage)
    {
        $this->posts = $posts;
        $this->nexPage = $nexPage;
    }

    /**
     * @return Collection
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * @param Collection $posts
     * @return $this
     */
    public function setPosts(Collection $posts): self
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * @return string
     */
    public function getNexPage(): string
    {
        return $this->nexPage;
    }

    /**
     * @param string $nexPage
     * @return $this
     */
    public function setNexPage(string $nexPage): self
    {
        $this->nexPage = $nexPage;

        return $this;
    }

}
