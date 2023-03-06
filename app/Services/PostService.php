<?php

namespace App\Services;

use App\DataFactories\PostFactory;
use App\DataTransfer\Request\PostRequest;
use App\DataTransfer\Request\RubricRequest;
use App\DataTransfer\Response\PostResponse;
use App\Domain\Rubric;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\RubricRepositoryInterface;
use Illuminate\Support\Collection;

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
    public function createPost(PostRequest $post): PostResponse
    {
        $dt = $this->postRepository->create([
            'title' => $post->getTitle(),
            'description' => $post->getDescription(),
            'content' => $post->getContent()
        ]);
        foreach ($post->getCategory() as $rubricId) {
            $this->rubricRepository->link($dt->getId(), $rubricId);
        }

        $rubrics = (new Collection($post->getCategory()))->map(function ($rubricId) {
            return $this->rubricRepository->find($rubricId);
        });

        return PostFactory::response(
            $dt->getId(),
            $dt->getTitle(),
            $dt->getDescription(),
            $dt->getContent(),
            $rubrics
        );
    }

    /**
     * @inheritDoc
     */
    public function getRubrics(): Collection
    {
        return $this->rubricRepository->all(['*'], ['container']);
    }

    /**
     * @inheritDoc
     */
    public function createRubric(RubricRequest $rubric): Rubric
    {
        return $this->rubricRepository->create([
            'name' => $rubric->getName()
        ], $rubric->getParent());
    }

    /**
     * @inheritDoc
     */
    public function getPosts(): Collection
    {
        $postRelations = $this->postRepository->getPostsWithRelations([], ['*'], ['relationship']);

        return $postRelations->map(function ($postRelation) {
            $rubrics = (new Collection($postRelation->getRelationshipIds()))->map(function ($relationshipId) {
                return $this->rubricRepository->getRubricByRelationship($relationshipId);
            });
            return PostFactory::response(
                $postRelation->getId(),
                $postRelation->getTitle(),
                $postRelation->getDescription(),
                $postRelation->getContent(),
                $rubrics
            );
        });
    }
}
