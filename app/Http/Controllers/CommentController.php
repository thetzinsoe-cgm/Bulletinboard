<?php

namespace App\Http\Controllers;

use App\Dao\PostDao;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Services\PostService;

class CommentController extends Controller
{
    private $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function getComment($postId)
    {
        $comments = $this->commentService->getComment($postId);
        $postService = new PostService(new PostDao());
        $post = $postService->getPostById($postId);
        return view('comment.comment', compact('comments','post'));
    }

    public function createComment(Request $request,int $id)
    {
        $this->commentService->addComment($request->only(['comment']),$id);
        return redirect()->back()->with('success','Upload Comment Successful');
    }
}
