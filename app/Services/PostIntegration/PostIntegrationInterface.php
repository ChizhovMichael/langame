<?php

namespace App\Services\PostIntegration;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

interface PostIntegrationInterface
{
    /**
     * @return Collection
     * @throws RequestException
     */
    public function getPosts(): Collection;
}
