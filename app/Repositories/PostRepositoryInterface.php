<?php

namespace App\Repositories;

use App\Domain\Post;

interface PostRepositoryInterface
{
    /**
     * @param array $payload
     * @return void
     */
    public function create(array $payload): Post;
}
