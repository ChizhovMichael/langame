<?php

namespace App\Http\Controllers\Api;

use App\DataTransfer\Request\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostCollection;
use App\Http\Resources\Api\PostResource;
use App\Services\PostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /** @var PostServiceInterface */
    private $service;

    /**
     * @param PostServiceInterface $service
     */
    public function __construct(PostServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $response = $this->service->getPosts();

        return response()->json([
            'data' => new PostCollection($response->sortDesc()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $category = $request->get('category') ?? [];
        $dt = new PostRequest(
            $request->get('title'),
            $request->get('description'),
            $request->get('content'),
            $category,
        );
        $post = $this->service->createPost($dt);

        return response()->json([
            'data' => new PostResource($post)
        ]);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'search' => 'max:255|nullable',
        ]);

        $response = $this->service->getPosts($request->get('search'));

        return response()->json([
            'data' => new PostCollection($response->sortDesc()),
        ]);
    }
}
