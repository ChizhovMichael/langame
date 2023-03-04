<?php

namespace App\Services\PostIntegration\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait BuildBaseRequest
{
    /**
     * @return PendingRequest
     */
    protected function buildRequest(): PendingRequest
    {
        return Http::baseUrl($this->apiUrl)->timeout(15);
    }
}
