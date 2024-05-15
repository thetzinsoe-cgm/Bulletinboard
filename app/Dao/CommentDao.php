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
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    /**
     * Get Comment By Id
     *
     * @param integer $cmId
     * @return object|null
     */
    public function getCommentById(int $cmId): object|null
    {
        return Comment::where('id', $cmId)->first();
    }

    /**
     * Adding Comment
     *
     * @return void
     */
    public function addComment(array $cmData): void
    {
        DB::transaction(function () use ($cmData) {
            Comment::create($cmData);
        });
    }

    /**
     * Update Comment
     *
     * @param array $cmData
     * @param integer $cmId
     * @return void
     */
    public function updateComment(array $cmData, int $cmId): void
    {
        DB::transaction(function () use ($cmData, $cmId) {
            Comment::find($cmId)->update($cmData);
        });
    }

    /**
     * Delete Comment
     *
     * @param integer $cmId
     * @return void
     */
    public function deleteComment(int $cmId): void
    {
        DB::transaction(function () use ($cmId) {
            Comment::findOrFail($cmId)->delete();
        });
    }
}
