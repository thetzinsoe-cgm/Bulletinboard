<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Contracts\Services\PostServiceInterface;
use App\Http\Requests\PostImportRequest;

class PostController extends Controller
{
    protected $postService;

    /**
     * Constructor
     *
     * @param PostServiceInterface $postServiceInterface
     */
    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postService = $postServiceInterface;
    }

    /**
     * show post List
     * @return \Illuminate\Contracts\View\View
     */
    public function postList()
    {
        $posts = $this->postService->getPost();
        return view('post.postList', compact('posts'));
    }

    /**
     * Show My post
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showMyPost()
    {
        $posts = $this->postService->getMyPost();
        return view('post.postList', compact('posts'));
    }

    /**
     * create post
     *
     * @param PostCreateRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function createPost()
    {
        return view('post.createPost');
    }

    /**
     * store post
     *
     * @param PostCreateRequest $request
     * @return void
     */
    public function storePost(PostCreateRequest $request)
    {
        $this->postService->createPost($request->only([
            'title',
            'description',
            'flag',
        ]));
        return redirect()->route('post#postList');
    }

    /**
     * edit post
     *
     * @param PostCreateRequest $request
     * @param integer $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editPost($id)
    {
        $post = $this->postService->getPostById($id);
        return view('post.editPost', compact('post'));
    }

    /**
     * update post
     *
     * @param PostCreateRequest $request
     * @param integer $id
     * @return void
     */
    public function updatePost(PostCreateRequest $request, int $id)
    {
        $this->postService->updatePost($request->only([
            'title',
            'description',
            'flag',
        ]), $id);
        return redirect()->route('post#postList');
    }

    /**
     * delete post
     *
     * @param int $id
     * @return void
     */
    public function deletePost(int $id)
    {
        $this->postService->deletePost($id);
        return redirect()->route('post#showMyPost');
    }

    /**
     * export CSV
     *
     * @return \Illuminate\Http\Response
     */
    public function exportCSV()
    {
        [$callback, $headers] = $this->postService->exportCSV();
        return response()->stream($callback, 200, $headers);
    }


    /**
     * Import CSV
     *
     * @param PostImportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importCSV(PostImportRequest $request)
    {
        $this->postService->importCSV($request);
        return redirect()->back()->with('success', config('message.upload_success'));
    }
}
