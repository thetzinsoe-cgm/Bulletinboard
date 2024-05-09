<?php

namespace App\Services;

use App\Mail\SendPassMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;

/**
 * User Service class
 */
class UserService implements UserServiceInterface
{
    /**
     * user Dao
     */
    private $userDao;

    /**
     * Class Construction
     *
     * @param UserDaoInterface $userDao
     * @return void
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * Get user list
     * @return object
     */
    public function getUsers(): object
    {
        return $this->userDao->getUsers();
    }

    /**
     * Save User
     *
     * @param array $data
     * @return void
     */
    public function createUser(array $data): void
    {
        $imgName = '';
        if (isset($data['image']) && $data['image']->isValid()) {
            $image = $data['image'];
            $imgName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imgName);
            $data['image'] = $imgName;
        }else{
            $data['image'] = null;
        }
        $this->userDao->createUser($data);
    }

    /**
     * Get user by Id
     *
     * @param integer $id
     * @return object
     */
    public function getUserById(int $id): object
    {
        return $this->userDao->getUserById($id);
    }

    /**
     * Update User
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateUser(array $data, int $id): void
    {
        $user = $this->userDao->getUserById($id);
        if (isset($data['image']) && $data['image']->isValid()) {
            $image = $data['image'];
            $imgName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imgName);
            $data['image'] = $imgName;
        } else {
            $data['image'] = $user->img;
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        $this->userDao->updateUser($data, $id);
    }

    /**
     * Delete user by id
     *
     * @param integer $id
     * @return void
     */
    public function deleteUserById(int $id): void
    {
        $this->userDao->deleteUserById($id);
    }

    /**
     * Login user by email and password
     *
     * @param [type] $user
     * @return object|null
     */
    public function checkLogin($user): ?object
    {
        return $this->userDao->checkLogin($user);
    }

    /**
     * find user with email
     * @return user
     */
    public function findUserWithEmail(string $email): ?object
    {
        return $this->userDao->findUserWithEmail($email);
    }

    /**
     * Undocumented function
     *
     * @param string $email
     * @return User|null
     */
    public function sendPassword(string $email): ?object
    {
        $user = $this->userDao->findUserWithEmail($email);
        $newPass = Str::ascii(Str::random(6));
        if ($user) {
            $user->password = $newPass;
            $this->userDao->updateUser($user->toArray(), $user->id);
            Mail::to($email)->send(new SendPassMail(['name' => $user->name, 'newPassword' => $newPass]));
        }
        return $user;
    }
}
