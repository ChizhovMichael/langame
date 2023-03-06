<?php

namespace App\Http\Controllers;

use App\DataTransfer\Request\PostRequest;
use App\DataTransfer\Request\RubricRequest;
use App\Services\PostServiceInterface;
use Illuminate\Http\RedirectResponse;
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
     * @return RedirectResponse
     */
    public function storePost(Request $request): RedirectResponse
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
        return redirect()->back()->with('posts', 'Blog Post Form Data Has Been inserted');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeRubric(Request $request): RedirectResponse
    {
        $request->validate([
            'rubric' => 'required|max:200',
        ]);
        $parent = $request->get('parent') ?? null;
        $dt = new RubricRequest(
            $request->get('rubric'),
            $parent
        );
        $this->service->createRubric($dt);
        return redirect()->back()->with('rubrics', 'Blog Rubric Form Data Has Been inserted');
    }
}
