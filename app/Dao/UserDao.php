<?php

namespace App\Dao;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
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
        return User::paginate(3);
    }

    /**
     * Save user
     * @param array
     * @return void
     */
    public function createUser(array $data): void
    {
        DB::transaction(function () use ($data) {
            User::create($data);
        });
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
     * Get post and comment by user id
     *
     * @param integer $id
     * @return object|null
     */
    public function getPostCmByUserId(int $id): object
    {
        return User::with(['posts.comments.user'])->findOrFail($id);
    }

    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateUser(array $data, $id): void
    {
        DB::transaction(function () use ($data, $id) {
            User::find($id)->update($data);
        });
    }

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteUserById($id): void
    {
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            Post::where('created_by', $id)->delete();
            Comment::where('user_id', $id)->delete();
            $user->delete();
        });
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
