<?php

namespace App\Contracts\Services;

use App\Models\User;
use SebastianBergmann\Type\NullType;

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
     * Get post and comment By user Id
     *
     * @param integer $id
     * @return object
     */
    public function getPostCmByUserId(int $id): ?object;

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
     * Check Login
     *
     * @param [type] $user
     * @return object|null
     */
    public function checkLogin($user): ?object;

    /**
     * Find user with email
     *
     * @param string $email
     * @return object|null
     */
    public function findUserWithEmail(string $email): ?object;

    public function sendPassword(string $email): ?object;
}
