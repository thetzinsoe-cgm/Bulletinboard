<?php

namespace App\Http\Controllers;

use App\Dao\PostDao;
use App\Models\Comment;
use Illuminate\Database\Console\Migrations\RefreshCommand;
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
        $comments = $this->commentService->getCommentByPost($postId);
        $postService = new PostService(new PostDao());
        $post = $postService->getPostById($postId);
        return view('comment.comment', compact('comments', 'post'));
    }

    public function createComment(Request $request, int $id)
    {
        $this->commentService->addComment($request->only(['comment']), $id);
        return redirect()->back()->with('success', 'Upload Comment Successful');
    }

    public function editComment(int $commentId)
    {
        $editComment = $this->commentService->getCommentById($commentId);
        $comments = $this->commentService->getCommentByPost($editComment->post_id);
        $postService = new PostService(new PostDao());
        $post = $postService->getPostById($editComment->post_id);
        return view('comment.comment', compact('comments', 'post','editComment'));
    }

    public function updateComment(Request $request, int $commentId)
    {
        $comment = $this->commentService->getCommentById($commentId);
        $this->commentService->updateComment($request->only(['comment']), $commentId);
        return redirect()->route('post#comment',$comment->post_id)->with('success','Update Successful');
    }

    public function deleteComment(int $commentId)
    {
        $comment = $this->commentService->getCommentById($commentId);
        $this->commentService->deleteComment($commentId);
        $comments = $this->commentService->getCommentByPost($comment->post_id);
        return redirect()->route('post#comment',$comment->post_id)->with('success','Delete Successful');
    }
}
