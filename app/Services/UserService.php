<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
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
     * Class Constructor
     * @param UserDaoInterface
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
     * Save user
     * @param array
     * @return void
     */
    public function createUser(array $data): void
    {
        $this->userDao->createUser($data);
    }

    /**
     * Get user by id
     * @param int $id
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
        $this->userDao->updateUser($data, $id);
    }

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteUserById(int $id): void
    {
        $this->userDao->deleteUserById($id);
    }

    /**
     * Login user by email and password
     * @param Request data
     * @return user
     */
    public function checkLogin($user): ?object
    {
       return $this->userDao->checkLogin($user);
    }
}
