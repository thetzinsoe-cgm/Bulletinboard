<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for user
 */
interface UserDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getUsers(): object;

    /**
     * Save user
     * @param array
     * @return void
     */
    public function createUser(array $data): void;

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getUserById(int $id): object;

    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateUser(array $data, int $id): void;

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteUserById(int $id): void;

    /**
     * Login user by email and password
     * @param Request data
     * @return User
     */
    public function checkLogin($user):?object;

    /**
     * find email
     * @param string $email
     * @return User
     */
    public function findUserWithEmail(string $email):?object;
}
