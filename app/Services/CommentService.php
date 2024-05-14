<?php

namespace App\Services;

use App\Dao\CommentDao;
use App\Models\Comment;
use App\Contracts\Services\CommentServiceInterface;

class CommentService implements CommentServiceInterface
{
    private $commentDao;

    /**
     * Constructor
     *
     * @param CommentDao $commentDao
     */
    public function __construct(CommentDao $commentDao)
    {
        $this->commentDao = $commentDao;
    }

    /**
     * Get Comment
     *
     * @param integer $postId
     * @return Comment|null
     */
    public function getCommentByPost(int $postId): ?object
    {
        return $this->commentDao->getCommentByPost($postId);
    }

    /**
     * Get Comment By CommentId
     *
     * @param integer $commentId
     * @return object|null
     */
    public function getCommentById(int $commentId): object|null
    {
        return $this->commentDao->getCommentById($commentId);
    }

    /**
     * Add Comment
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function addComment(array $data, int $id): void
    {
        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $id;
        $this->commentDao->addComment($data, $id);
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
        $this->commentDao->updateComment($data, $id);
    }

    /**
     * Delete Comment
     *
     * @param integer $id
     * @return void
     */
    public function deleteComment(int $id): void
    {
        $this->commentDao->deleteComment($id);
    }
}
