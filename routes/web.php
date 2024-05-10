<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::prefix('user')->group(function () {
    Route::get('/list', [UserController::class, 'userList'])->name('user#list');
    Route::get('/create', [UserController::class, 'createUser'])->name('user#create');
    Route::post('/store', [UserController::class, 'storeUser'])->name('store#user');
    Route::get('/detail/{id}', [UserController::class, 'detailUser'])->name('user#detail');
    Route::post('/update/{id}', [UserController::class, 'updateUser'])->name('user#update');
    Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('user#delete');
    Route::get('/login', [UserController::class, 'loginUser'])->name('user#login');
    Route::post('/checkLogin', [UserController::class, 'checkLogin'])->name('user#checkLogin');
    Route::post('/logout', [UserController::class, 'signOut'])->name('user#signOut');
    Route::get('/changePassword', [UserController::class, 'changePassword'])->name('user#changePassword');
    Route::post('/updatePassword', [UserController::class, 'updatePassword'])->name('user#updatePassword');
    Route::get('/forgotPassword', [UserController::class, 'forgotPassword'])->name('user#forgotPassword');
    Route::post('/sendPassword', [UserController::class, 'sendPassword'])->name('user#sendPassword');
});

Route::prefix('post')->group(function () {
    Route::get('/postList', [PostController::class, 'postList'])->name('post#postList');
    Route::get('/create', [PostController::class, 'createPost'])->name('post#create');
    Route::post('/store', [PostController::class, 'storePost'])->name('post#store');
    Route::get('/edit/{id}', [PostController::class, 'editPost'])->name('post#edit');
    Route::post('/update/{id}', [PostController::class, 'updatePost'])->name('post#update');
    Route::post('/delete/{id}', [PostController::class,'deletePost'])->name('post#delete');
});
