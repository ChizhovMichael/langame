<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    /**
     * @param array $payload
     * @return void
     */
    public function create(array $payload): int;
}
