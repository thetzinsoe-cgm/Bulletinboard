<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Services\UserServiceInterface;

class UserController extends Controller
{
    /**
     * user interface
     */
    private $userService;
    const ADMIN_ROLE = 1;
    const USER_ROLE = 2;

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
     * @return view user create
     */
    public function index()
    {
        $user = null;
        return view('user.createUser', compact('user'));
    }

    /**
     * Show user list
     *
     * @return view user list
     */
    public function userList()
    {
        $users = $this->userService->getUsers();
        return view('user.userList', compact('users'));
    }

    /**
     * Create user
     * @return view create user
     */
    public function createUser()
    {
        return view('user.createUser');
    }

    /**
     * Store User
     *
     * @param Request $request
     * @return view
     */
    public function storeUser(Request $request)
    {
        $user = $this->userService->findUserWithEmail($request->email);
        if ($user) {
            return redirect()->back()->with('error', 'This email is already in use!');
        } else {
            $this->userService->createUser($request->only([
                'email',
                'password',
                'name',
                'image',
            ]));
            return redirect()->route('user#list');
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $id
     * @return view
     */
    public function detailUser(Request $request, $id)
    {
        $user = $this->userService->getUserById($id);
        return view('user.editUser', compact('user'));
    }

    /**
     * update User
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function updateUser(Request $request, $id)
    {
        $user = $this->userService->findUserWithEmail($request->email);
        if ($user && $user->id != $id) {
            return redirect()->back()->with('error', 'This email is already in use!');
        } else {
            $this->userService->updateUser($request->only([
                'email',
                'password',
                'name',
                'image',
                'role',
            ]), $id);
            return redirect()->route('user#list');
        }
    }

    /**
     * Delete user
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        $this->userService->deleteUserById($id);
        return redirect()->back();
    }

    /**
     * Login user
     * @return view login user
     */
    public function loginUser()
    {
        return view('user.loginUser');
    }

    /**
     * check login
     * @param Request Data
     * @return user
     */
    public function checkLogin(Request $request)
    {
        $credential = $request->only([
            'email',
            'password',
        ]);
        $user = $this->userService->checkLogin($credential);
        if (Auth::attempt($credential)) {
            if ($user->role == self::ADMIN_ROLE) {
                return redirect()->route('user#list');
            } else {
                return redirect()->route('post#postList');
            }
        }
        return redirect()->back()->with('error', 'Email address or password is incorrect');
    }

    /**
     * change password
     * @return view
     */
    public function changePassword()
    {
        return view('user.changePassword');
    }

    /**
     * update Password
     *
     * @param Request $request
     * @return view
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $this->resetPassword($user, $request->input('passwordConfirmation'));

        if ($user->role == self::ADMIN_ROLE) {
            return redirect()->route('user#list')->with('success', 'Password updated successfully.'); // Redirect admin user
        } else {
            return redirect()->route('post#postList'); // Redirect regular user
        }
    }

    /**
     * to signout
     * @return view
     */
    public function signOut()
    {
        Auth::logout();
        return Redirect()->route('user#login');
    }

    /**
     * forgot password
     *
     * @return void
     */
    public function forgotPassword()
    {
        return view('user.forgotPassword');
    }

    /**
     * Password send from mail
     * @return view
     * @param Request data
     */
    public function sendPassword(Request $request)
    {
        $email = $request->input('email');
        $user = $this->userService->sendPassword($email);

        if ($user) {
            return redirect()->back()->with('success', 'Password reset email sent successfully, check your mail box!');
        } else {
            return redirect()->back()->with('error', 'Email not found.');
        }
    }

    /**
     * reset Password
     *
     * @param [type] $user
     * @param [type] $password
     * @return void
     */
    public function resetPassword($user, $password)
    {
        $userData = [
            'email' => $user->email,
            'password' => $password, // Use 'password' for new password
            'name' => $user->name,
            'image' => $user->image,
            'role' => $user->role
        ];
        $this->userService->updateUser($userData, $user->id);
    }
}
