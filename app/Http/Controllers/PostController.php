<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use App\Http\Requests\PostCreateRequest;
use App\Contracts\Services\PostServiceInterface;

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
        $post = new Post();
        $post->flag = true;
        return view('post.createPost', compact('post'));
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
     * @param [type] $id
     * @return void
     */
    public function deletePost($id)
    {
        $this->postService->deletePost($id);
        return redirect()->route('post#postList');
    }
}
