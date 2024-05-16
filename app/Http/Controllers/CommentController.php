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

    /**
     * Constructor
     *
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;

    }

    /**
     * Get Comment
     *
     * @param int $postId
     * @return \Illuminate\Contracts\View\View
     */
    public function getComment($postId)
    {
        $comments = $this->commentService->getCommentByPost($postId);
        return view('comment.comment', compact('comments'));
    }

    /**
     * Create Comment
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createComment(Request $request, int $id)
    {
        $this->commentService->addComment($request->only(['comment']), $id);
        return redirect()->back()->with('success', 'Upload Comment Successful');
    }

    /**
     * Edit Comment
     *
     * @param integer $commentId
     * @return \Illuminate\Contracts\View\View
     */
    public function editComment(int $commentId)
    {
        $editComment = $this->commentService->getCommentById($commentId);
        $comments = $this->commentService->getCommentByPost($editComment->post_id);
        return view('comment.comment', compact('comments','editComment'));
    }

    /**
     * Update Comment
     *
     * @param Request $request
     * @param integer $commentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateComment(Request $request, int $commentId)
    {
        $comment = $this->commentService->getCommentById($commentId);
        $this->commentService->updateComment($request->only(['comment']), $commentId);
        return redirect()->route('post#comment',$comment->post_id)->with('success','Update Successful');
    }

    /**
     * Delete Comment
     *
     * @param integer $commentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteComment(int $commentId)
    {
        $comment = $this->commentService->getCommentById($commentId);
        $this->commentService->deleteComment($commentId);
        return redirect()->route('post#comment',$comment->post_id)->with('success','Delete Successful');
    }
}
