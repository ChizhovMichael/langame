<?php

namespace App\Services\PostIntegration;

use App\DataFactories\PostFactory;
use App\Services\PostIntegration\Concerns\BuildBaseRequest;
use App\Services\PostIntegration\Concerns\SendGetRequest;
use Illuminate\Support\Collection;

class PostIntegrationService implements PostIntegrationInterface
{
    use BuildBaseRequest;
    use SendGetRequest;

    /** @var string  */
    private $apiUrl;

    /** @var string */
    private $apiToken;

    /**
     * @param string $apiUrl
     * @param string $apiToken
     */
    public function __construct(string $apiUrl, string $apiToken)
    {
        $this->apiUrl = $apiUrl;
        $this->apiToken = $apiToken;
    }


    /**
     * @inheritDoc
     */
    public function getPosts(): Collection
    {
        $response = $this->get($this->buildRequest(), "/news", [
            'language' => 'en',
            'country' => 'ca'
        ])->throw();

        $articles = $response->collect()->get('results');

        return PostFactory::collection($articles);
    }

}
