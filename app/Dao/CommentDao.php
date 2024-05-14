<?php

namespace App\Dao;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\CommentDaoInterface;

class CommentDao implements CommentDaoInterface
{
    /**
     * Get comment for post
     *
     * @param integer $postId
     * @return Comment|null
     */
    public function getCommentByPost(int $postId): ?Object
    {
        return DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.name')->where('comments.post_id', $postId)
            ->orderBy('updated_at','desc')
            ->get();
    }

    public function getCommentById(int $commentId): object|null
    {
        return Comment::where('id', $commentId)->first();
    }

    /**
     * Adding Comment
     *
     * @return void
     */
    public function addComment(array $data): void
    {
        Comment::create($data);
    }

    /**
     * Update Comment
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function updateComment(array $data, int $id): void
    {
        Comment::find($id)->update($data);
    }

    /**
     * Delete Comment
     *
     * @param integer $id
     * @return void
     */
    public function deleteComment(int $id): void
    {
        Comment::destroy($id);
    }
}
