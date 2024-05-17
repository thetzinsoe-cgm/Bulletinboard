<?php
namespace App\Contracts\Services;

use App\Http\Requests\PostCreateRequest;

interface PostServiceInterface
{
     /**
     * Get user list
     * @return object
     */
    public function getPost():object;

    /**
     * Get My Post
     *
     * @return object
     */
    public function getMyPost():object;

    /**
     * create post
     *
     * @return void
     */
    public function createPost(array $data):void;

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

    /**
     * Export CSV
     *
     * @return array
     */
    public function exportCSV():array;

    /**
     * Import CSV
     *
     * @return void
     */
    public function importCSV($file):void;
}
