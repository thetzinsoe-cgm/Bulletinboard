<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Services\PostServiceInterface;

class PostService implements PostServiceInterface
{
    private $postDao;
    /**
     * constructor class
     *
     * @param PostDaoInterface $postDao
     */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Get user list
     * @return object
     */
    public function getPost(): object
    {
        if (Auth::guest()) {
            return $this->postDao->getAllPost();
        } else {
            return $this->postDao->getPublicPost();
        }
    }

    /**
     * Get My Post
     *
     * @return object
     */
    public function getMyPost(): object
    {
        return $this->postDao->getMyPost(Auth::user()->id);
    }

    /**
     * create post
     *
     * @return void
     */
    public function createPost(array $data): void
    {
        $data['created_by'] = auth()->user()->id ?? null;
        $data['created_at'] = now();
        $this->postDao->createPost($data);
    }

    /**
     * Get one post
     * @return object
     * @param int $id
     */
    public function getPostById(int $id): object
    {
        return $this->postDao->getPostById($id);
    }

    /**
     * Update Post
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updatePost(array $data, int $id): void
    {
        $data['updated_by'] = auth()->user()->id ?? null;
        $data['updated_at'] = now();
        $this->postDao->updatePost($data, $id);
    }

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deletePost(int $id): void
    {
        $this->postDao->deletePost($id);
    }
}
