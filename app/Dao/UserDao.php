<?php

namespace App\Dao;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\UserDaoInterface;
use Illuminate\Support\Facades\Storage;

class UserDao implements UserDaoInterface
{
    /**
     * Get user list
     * @return object
     */
    public function getUsers(): object
    {
        return User::get();
    }

    /**
     * Save user
     * @param array
     * @return void
     */
    public function createUser(array $data): void
    {
        User::create($data);
    }

    /**
     * Get user by id
     * @param int $id
     * @return object
     */
    public function getUserById($id): object
    {
        $user = User::findOrFail($id);
        return $user;
    }


    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateUser(array $data, $id): void
    {
        $user = User::findOrFail($id);
        $user->update($data);
    }

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteUserById($id): void
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    /**
     * check login
     *
     * @param [type] $user
     * @return object|null
     */
    public function checkLogin($user): object
    {
        $email = $user['email'];
        return User::where('email', $email)->first();
    }

    /**
     * find user by email
     *
     * @param string $email
     * @return User|null
     */
    public function findUserWithEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
