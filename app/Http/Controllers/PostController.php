<?php

namespace App\Http\Controllers;

use App\DataTransfer\Request\PostRequest;
use App\Services\PostServiceInterface;
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
        $this->service->createPost($dt);
        return redirect()->back()->with('status', 'Blog Post Form Data Has Been inserted');
    }
}
