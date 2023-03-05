<?php

namespace App\Services;

use App\DataTransfer\Post;
use App\DataTransfer\Rubric;
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
     * @param Rubric $rubric
     * @return void
     */
    private function importRubric(Rubric $rubric): void
    {
        $name = $rubric->getName();
        $rubric = $this->rubricRepository->findByColumns([
            'name' => $name
        ]);
        if (!$rubric) {
            $this->rubricRepository->create([
                'name' => $name
            ]);
        }
    }

    /**
     * @inheritDoc
     */
    public function importPost(Post $post): void
    {
        $rubrics = $post->getRubrics();
        foreach ($rubrics as $rubric) {
            $this->importRubric($rubric);
        }
        $postId = $this->postRepository->create([
            'title' => $post->getTitle(),
            'description' => $post->getDescription(),
            'content' => $post->getContent()
        ]);
        if ($postId) {
            foreach ($rubrics as $rubric) {
                $this->rubricRepository->link($postId, $rubric);
            }
        }
    }
}
