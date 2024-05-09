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
        $imgName = '';
        if (isset($data['image']) && $data['image']->isValid()) {
            $image = $data['image'];
            $imgName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imgName);
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'img' => $imgName,
            'role' => $data['role'] ?? 2,
            'created_at' => now(),
        ]);
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
        $imgName = '';
        $user = User::findOrFail($id);
        if (isset($data['image']) && $data['image']->isValid()) {
            $image = $data['image'];
            $imgName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imgName);
        } else {
            $user = User::find($id);
            $imgName = $user->img;
        }

        if (isset($data['password'])) {
            $password = Hash::make($data['password']);
        } else {
            $password = $user->password;
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password,
            'img' => $imgName,
            'role' => $data['role'] ?? 2,
            'updated_at' => now(),
        ]);
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
     * Login user by email and password
     * @param Request data
     * @return User
     */
    public function checkLogin($user): ?object
    {
        $email = $user['email'];
        $foundUser = User::where('email', $email)->first();
        if (!$foundUser) {
            return null;
        }
        return $foundUser;
    }

    /**
     * find user with email
     * @return user
     */
    /**
     * Find user by email
     * @param string $email
     * @return User|null
     */
    public function findUserWithEmail(string $email): ?object
    {
        return User::where('email', $email)->first();
    }
}
