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
    public function getComment(int $postId): ?Object
    {
        return Comment::where('post_id', $postId)->get();
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
        $comment = Post::find($id);
        Comment::update($comment);
    }

    /**
     * Delete Comment
     *
     * @param integer $id
     * @return void
     */
    public function deleteComment(int $id): void
    {
        Post::destroy($id);
    }
}
