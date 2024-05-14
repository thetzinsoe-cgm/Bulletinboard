<?php
namespace App\Contracts\Dao;

use App\Models\Comment;

interface CommentDaoInterface
{
    /**
     * Get comment for post
     *
     * @param integer $postId
     * @return Comment|null
     */
    public function getCommentByPost(int $postId):?object;

    /**
     * Get Comment by Comment Id
     *
     * @param integer $commentId
     * @return object|null
     */
    public function getCommentById(int $commentId):?object;

    /**
     * Adding Comment
     *
     * @return void
     */
    public function addComment(array $data):void;

    /**
     * Update Comment
     *
     * @param integer $id
     * @return void
     */
    public function updateComment(array $data,int $id):void;

    /**
     * Delete Comment
     *
     * @param integer $id
     * @return void
     */
    public function deleteComment(int $id):void;
}
