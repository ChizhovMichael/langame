<?php

namespace App\Services\PostIntegration;

use App\DataTransfer\Request\PostRequest;
use App\DataTransfer\Response\PostIntegrationResponse;
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
    public function getPosts(?string $page = null): PostIntegrationResponse
    {
        $response = $this->get($this->buildRequest(), "/news", [
            'language' => 'en',
            'page' => $page
        ])->throw();
        $response = $response->collect();
        $articles = $response->get('results');
        $nextPage = $response->get('nextPage');

        $articles = (new Collection($articles))->map(function ($item) {
            return new PostRequest(
                $item['title'],
                $item['description'],
                $item['content'],
                $item['category']
            );
        });

        return new PostIntegrationResponse($articles, $nextPage);
    }

}
