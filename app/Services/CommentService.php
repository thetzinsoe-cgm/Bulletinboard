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
     * @param integer $cmId
     * @return object|null
     */
    public function getCommentById(int $cmId): object|null
    {
        return $this->commentDao->getCommentById($cmId);
    }

    /**
     * Add Comment
     *
     * @param array $cmData
     * @param integer $cmId
     * @return void
     */
    public function addComment(array $cmData, int $cmId): void
    {
        $cmData['user_id'] = auth()->user()->id;
        $cmData['post_id'] = $cmId;
        $this->commentDao->addComment($cmData, $cmId);
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
        $this->commentDao->updateComment($cmData, $cmId);
    }

    /**
     * Delete Comment
     *
     * @param integer $cmId
     * @return void
     */
    public function deleteComment(int $cmId): void
    {
        $this->commentDao->deleteComment($cmId);
    }
}
