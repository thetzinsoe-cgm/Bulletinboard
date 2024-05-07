<?php

namespace App\Dao;

use App\Models\User;
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
            'password' => bcrypt($data['password']),
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
        return User::findOrFail($id);
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
        if (isset($data['image']) && $data['image']->isValid()) {
            $image = $data['image'];
            $imgName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imgName);
        }else{
            $user = User::find($id);
            $imgName = $user->img;
        }

        $user = User::findOrFail($id);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
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
}
