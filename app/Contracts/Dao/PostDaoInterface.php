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
     * Get all post
     * @return object
     */
    public function getAllPost():object;

    /**
     * Get Public Post
     *
     * @return object
     */
    public function getPublicPost():object;

    /**
     * Get My Post
     *
     * @param integer $userId
     * @return object
     */
    public function getMyPost(int $userId):object;

    /**
     * create psot
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
