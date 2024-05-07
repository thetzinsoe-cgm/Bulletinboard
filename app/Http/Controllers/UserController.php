<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Contracts\Services\UserServiceInterface;
use App\Services\UserService;

class UserController extends Controller
{
     /**
     * user interface
     */
    private $userService;

    /**
     * Create a new controller instance.
     * @param UserServiceInterface $userServiceInterface
     * @return void
     */
    public function __construct(UserServiceInterface $userServiceInterface)
    {
        $this->userService = $userServiceInterface;
    }

    /**
     * Show user list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = null;
        return view('user.createUser',compact('user'));
    }

    /**
     * Show user list
     *
     * @return \Illuminate\Http\Response
     */
    public function userList()
    {
        $users = $this->userService->getUsers();
        return view('user.userList',compact('users'));
    }

    /**
     * Create user
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        return view('user.createUser');
    }

     /**
     * Store user
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $this->userService->createUser($request->only([
            'email',
            'password',
            'name',
            'image',
        ]));
        return redirect()->route('user#list');
    }

     /**
     * Detail user
     * * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailUser(Request $request,$id)
    {
        $user = $this->userService->getUserById($id);
        return view('user.editUser',compact('user'));
    }

     /**
     * Update user
     *
     * @return view
     */
    public function updateUser(Request $request,$id)
    {
        $this->userService->updateUser($request->only([
            'email',
            'password',
            'name',
            'image',
        ]), $id);
        return redirect()->route('user#list');
    }

     /**
     * Delete user
     * @param  \App\Http\Requests\UserCreateRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request,$id)
    {
        $this->userService->deleteUserById($id);
        return redirect()->back();
    }
}
