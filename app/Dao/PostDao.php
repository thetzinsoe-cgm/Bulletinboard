<?php

namespace App\Dao;


use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\PostDaoInterface;
use App\Models\Comment;

class PostDao implements PostDaoInterface
{
    /**
     * Get post list
     * @return object
     */
    public function getAllPost(): object
    {
        return Post::where('flag', true)->orderBy('updated_at', 'Desc')->paginate(2);
    }

    /**
     * Get public Post
     *
     * @return object
     */
    public function getPublicPost(): object
    {
        return Post::orderBy('updated_at', 'Desc')->paginate(2);
    }

    /**
     * get my post
     *
     * @param integer $userId
     * @return object
     */
    public function getMypost(int $userId): object
    {
        return Post::where('created_by', $userId)->orderBy('updated_at', 'Desc')->paginate(2);
    }

    /**
     * create post
     * @param array $postData
     * @return void
     */
    public function createPost(array $postData): void
    {
        DB::transaction(function () use ($postData) {
            Post::create($postData);
        });
    }

    /**
     * Get one post
     * @return object
     * @param int $postId
     */
    public function getPostById(int $postId): object
    {
         return Post::where('id',$postId)->first();
    }

    /**
     * Update Post
     * @param array $postData
     * @param int $postId
     * @return void
     */
    public function updatePost(array $postData, int $postId): void
    {
        DB::transaction(function () use ($postData, $postId) {
            Post::where('id', $postId)->update($postData);
        });
    }

    /**
     * Delete post by id
     * @param int $postId
     * @return void
     */
    public function deletePost(int $postId): void
    {
        DB::transaction(function () use ($postId) {
            Post::where('id',$postId)->delete();
        });
    }
}
