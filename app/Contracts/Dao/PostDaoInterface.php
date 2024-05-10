<?php
namespace App\Contracts\Dao;

use GuzzleHttp\Psr7\Request;
use PhpParser\Builder\Interface_;

/*
*Interface of Data Access object for Post
*
*/
interface PostDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getPost():object;

    /**
     * create user
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
}
