<?php

use App\Http\Middleware\IsOwnPost;
use App\Http\Middleware\IsLoggedIn;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdminOrIsAuthorize;
use App\Http\Middleware\IsNewUser;
use App\Http\Middleware\IsOwnComment;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::prefix('user')->group(function () {
    Route::group(['middleware' => [IsNewUser::class]], function () {
        Route::get('/create', [UserController::class, 'createUser'])->name('user#create');
        Route::post('/store', [UserController::class, 'storeUser'])->name('store#user');
        Route::get('/login', [UserController::class, 'loginUser'])->name('user#login');
        Route::post('/checkLogin', [UserController::class, 'checkLogin'])->name('user#checkLogin');
    });
    Route::post('/logout', [UserController::class, 'signOut'])->name('user#signOut');
    Route::group(['middleware' => [IsLoggedIn::class]], function () {
        Route::get('/changePassword', [UserController::class, 'changePassword'])->name('user#changePassword');
        Route::post('/updatePassword', [UserController::class, 'updatePassword'])->name('user#updatePassword');
        Route::get('/forgotPassword', [UserController::class, 'forgotPassword'])->name('user#forgotPassword');
        Route::post('/sendPassword', [UserController::class, 'sendPassword'])->name('user#sendPassword');
        Route::group(['middleware' => [IsAdminOrIsAuthorize::class]], function () {
            Route::get('/list', [UserController::class, 'userList'])->name('user#list');
            Route::get('/detail/{id}', [UserController::class, 'detailUser'])->name('user#detail');
            Route::post('/update/{id}', [UserController::class, 'updateUser'])->name('user#update');
            Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('user#delete');
        });
    });
});

Route::prefix('post')->middleware(IsLoggedIn::class)->group(function () {
    Route::get('/postList', [PostController::class, 'postList'])->name('post#postList')->withoutMiddleware(IsLoggedIn::class);
    Route::get('/myPost', [PostController::class, 'showMyPost'])->name('post#showMyPost');
    Route::get('/create', [PostController::class, 'createPost'])->name('post#create');
    Route::post('/store', [PostController::class, 'storePost'])->name('post#store');
    Route::group(['middleware' => [IsOwnPost::class]], function () {
        Route::get('/edit/{id}', [PostController::class, 'editPost'])->name('post#edit');
        Route::post('/update/{id}', [PostController::class, 'updatePost'])->name('post#update');
        Route::post('/delete/{id}', [PostController::class, 'deletePost'])->name('post#delete');
    });

    Route::get('/{id}/comments', [CommentController::class, 'getComment'])->name('post#comment');
    Route::post('/{id}/commentCreate', [CommentController::class, 'createComment'])->name('post#createComment');
    Route::get('/comment/{id}/edit', [CommentController::class, 'editComment'])->name('post#editComment')->middleware(IsOwnComment::class);
    Route::patch('/comment/{id}/update', [CommentController::class, 'updateComment'])->name('post#updateComment')->middleware(IsOwnComment::class);
    Route::post('/comment/{id}', [CommentController::class, 'deleteComment'])->name('post#deleteComment');
});
