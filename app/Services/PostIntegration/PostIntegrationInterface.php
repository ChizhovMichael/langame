<?php

namespace App\Services\PostIntegration;

use App\DataTransfer\Response\PostResponse;
use Illuminate\Http\Client\RequestException;

interface PostIntegrationInterface
{
    /**
     * @param string|null $page
     * @return PostResponse
     * @throws RequestException
     */
    public function getPosts(?string  $page = null): PostResponse;
}
