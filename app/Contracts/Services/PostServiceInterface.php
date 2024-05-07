<?php
namespace App\Contracts\Services;

interface PostServiceInterface
{
     /**
     * Get user list
     * @return object
     */
    public function getPost():object;

    /**
     * create user
     */
    public function createPost():void;

    /**
     * Get one post
     * @return object
     * @param int $id
     */
    public function getPostById(int $id):object;

    /**
     * Update Post
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updatePost(array $data,int $id):void;

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deletePost(int $id):void;
}
