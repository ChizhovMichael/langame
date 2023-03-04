<?php

namespace App\Services\PostIntegration\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

trait SendGetRequest
{
    /**
     * @param PendingRequest $request
     * @param string $url
     * @param array|string|null $query
     * @return Response
     */
    public function get(PendingRequest $request, string $url, $query = null): Response
    {
        return $request->get($url, array_merge(['apikey' => $this->apiToken], $query));
    }
}
