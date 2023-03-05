<?php

namespace App\Services;

use App\DataTransfer\Request\PostRequest;
use App\Domain\Post;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\RubricRepositoryInterface;

class PostService implements PostServiceInterface
{
    /** @var RubricRepositoryInterface */
    private $rubricRepository;

    /** @var PostRepositoryInterface */
    private $postRepository;

    /**
     * @param RubricRepositoryInterface $rubricRepository
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        RubricRepositoryInterface $rubricRepository,
        PostRepositoryInterface $postRepository
    )
    {
        $this->rubricRepository = $rubricRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @param string $rubricName
     * @return int
     */
    private function importRubric(string $rubricName): int
    {
        $rubric = $this->rubricRepository->findByColumns([
            'name' => $rubricName
        ]);
        if ($rubric) return $rubric->getId();
        return $this->rubricRepository->create([
            'name' => $rubricName
        ])->getId();
    }

    /**
     * @inheritDoc
     */
    public function importPost(PostRequest $post): void
    {
        $category = [];
        foreach ($post->getCategory() as $rubricName) {
            $category[] = $this->importRubric($rubricName);
        }
        $post->setCategory($category);
        $this->createPost($post);
    }

    /**
     * @inheritDoc
     */
    public function createPost(PostRequest $post): Post
    {
        $dt = $this->postRepository->create([
            'title' => $post->getTitle(),
            'description' => $post->getDescription(),
            'content' => $post->getContent()
        ]);
        foreach ($post->getCategory() as $rubricId) {
            $this->rubricRepository->link($dt->getId(), $rubricId);
        }

        return $dt;
    }
}
