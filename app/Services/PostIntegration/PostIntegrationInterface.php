<?php

namespace App\Services\PostIntegration;

use App\DataTransfer\Response\PostIntegrationResponse;
use Illuminate\Http\Client\RequestException;

interface PostIntegrationInterface
{
    /**
     * @param string|null $page
     * @return PostIntegrationResponse
     * @throws RequestException
     */
    public function getPosts(?string  $page = null): PostIntegrationResponse;
}
