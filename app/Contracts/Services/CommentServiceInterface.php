<?php
namespace App\Contracts\Services;

use App\Models\Comment;

interface CommentServiceInterface
{
    /**
     * Get comment for post
     *
     * @param integer $postId
     * @return Comment|null
     */
    public function getComment(int $postId):?object;

    /**
     * Add comment
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function addComment(array $data,int $id):void;

    /**
     * update comment
     *
     * @param array $data
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
