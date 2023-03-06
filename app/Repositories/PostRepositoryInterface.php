<?php

namespace App\Repositories;

use App\Domain\Post;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    /**
     * @param array $payload
     * @return void
     */
    public function create(array $payload): Post;

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getPostsWithRelations(array $columns = ['*'], array $relations = []): Collection;
}
