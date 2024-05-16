<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Services\UserServiceInterface;

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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return redirect()->route("post#postList");
    }

    /**
     * Show user list
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function userList()
    {
        $users = $this->userService->getUsers();
        return view('user.userList', compact('users'));
    }

    /**
     * Create user
     * @return \Illuminate\Contracts\View\View
     */
    public function createUser()
    {
        return view('user.createUser');
    }

    /**
     * Store User
     *
     * @param Request $request
     * @return mixed
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
            Auth::attempt(request()->only('email', 'password'));
            return redirect()->route('post#postList'); // Or any desired route after login
        }
    }


    /**
     *Detail view of user
     *
     * @param Request $request
     * @param [type] $id
     * @return mixed
     */
    public function detailUser(Request $request, $id)
    {
        $user = $this->userService->getUserById($id);
        $postComment = $this->userService->getPostCmByUserId($id);
        return view('user.editUser', compact('user', 'postComment'));
    }

    /**
     * update User
     *
     * @param Request $request
     * @param [type] $id
     * @return \Illuminate\Http\RedirectResponse
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
            return redirect()->route('post#postList');
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
     * Login User
     *
     * @return \Illuminate\Contracts\View\Factory|Illuminate\Contracts\View\View
     */
    public function loginUser()
    {
        return view('user.loginUser');
    }


    /**
     * Check login
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkLogin(Request $request)
    {
        $credential = $request->only([
            'email',
            'password',
        ]);
        try {
            if (Auth::attempt($credential)) {
                $user = $this->userService->checkLogin($credential);
                if ($user->role == config('constants.ADMIN_ROLE')) {
                    return redirect()->route('user#list');
                } else {
                    return redirect()->route('post#postList');
                }
            }
            return redirect()->back()->with('error', 'Email address or password is incorrect');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * change password
     * @return \Illuminate\Contracts\View\View
     */
    public function changePassword()
    {
        return view('user.changePassword');
    }

    /**
     * update Password
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $authUser = auth()->user();
        $user['id'] = $authUser->id;
        $user['email'] = $authUser->email;
        $user['password'] = $authUser->password;
        $user['role'] = $authUser->role;

        if (!Hash::check($request->input('password'), $user['password'])) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $user['password'] = $request->input('passwordConfirmation');
        $this->userService->updateUser($user, $user['id']);

        if ($user['role'] == config('constants.ADMIN_ROLE')) {
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
     * @return \Illuminate\Contracts\View\View
     */
    public function forgotPassword()
    {
        return view('user.forgotPassword');
    }

    /**
     * Password send from mail
     *
     * @param Request data
     * @return \Illuminate\Http\RedirectResponse
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
}
