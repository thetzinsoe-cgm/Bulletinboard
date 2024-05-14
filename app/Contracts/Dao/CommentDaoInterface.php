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
    public function getComment(int $postId):?object;

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
