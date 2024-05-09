<?php

namespace App\Contracts\Services;

/**
 * Interface for user service
 */
interface UserServiceInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getUsers(): object;

    /**
     * Save user
     * @param array $data
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
     * Login User By email and password
     * @param Request data
     * @return user
     */
    public function checkLogin($user):?object;

    /**
     * find user with email
     * @return user
     */
    public function findUserWithEmail(string $email):?object;
}
