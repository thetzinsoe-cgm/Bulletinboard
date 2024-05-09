<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendPassMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    public function detailUser(Request $request, $id)
    {
        $user = $this->userService->getUserById($id);
        return view('user.editUser', compact('user'));
    }

    /**
     * Update user
     * @return view
     */
    public function updateUser(Request $request, $id)
    {
        $this->userService->updateUser($request->only([
            'email',
            'password',
            'name',
            'image',
            'role',
        ]), $id);
        return redirect()->route('user#list');
    }

    /**
     * Delete user
     * @param  \App\Http\Requests\UserCreateRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request, $id)
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
            if ($user->role == 1) {
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
     * update password
     * @return view
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $this->resetPassword($user,$request->input('passwordConfirmation'));

        if ($user->role == 1) {
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
     * @return view
     */
    public function forgotPassword()
    {
        return view('user.forgotPassword');
    }

    public function sendPassword(Request $request)
    {
        // Retrieve email from the request
        $email = $request->input('email');
        $user = $this->userService->findUserWithEmail($email);
        $newPass = Str::ascii( Str::random(6) );

        if ($user) {
            $this->resetPassword($user,$newPass);
            Mail::to($email)->send(new SendPassMail(['name' => $user->name,'newPassword'=>$newPass]));
            return redirect()->back()->with('success', 'Password reset email sent successfully, check your mail box!');
        } else {
            return redirect()->back()->with('error', 'Email not found.');
        }
    }

     /**
     * reset Password
     * @return void
     */
    public function resetPassword($user,$password)
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
