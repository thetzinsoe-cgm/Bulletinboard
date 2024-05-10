<?php

namespace App\Dao;


use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\PostDaoInterface;

class PostDao implements PostDaoInterface
{
    /**
     * Get post list
     * @return object
     */
    public function getPost(): object
    {
        return Post::orderBy('updated_at','Desc')->get();
    }

    /**
     * create post
     *
     * @return void
     */
    public function createPost(array $data): void
    {
        Post::create($data);
    }

    /**
     * Get one post
     * @return object
     * @param int $id
     */
    public function getPostById(int $id): object
    {
        return Post::findOrFail($id);
    }

    /**
     * Update Post
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updatePost(array $data, int $id): void
    {
        Post::findOrFail($id)->update($data);
    }

    /**
     * Delete post by id
     * @param int $id
     * @return void
     */
    public function deletePost(int $id): void
    {
        Post::destroy($id);
    }
}
