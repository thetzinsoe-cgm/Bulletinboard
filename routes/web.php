<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'index'])->name('home');
Route::prefix('user')->group(function () {
    Route::get('/list',[UserController::class,'userList'])->name('user#list');
    Route::get('/create',[UserController::class,'createUser'])->name('user#create');
    Route::post('/store',[UserController::class,'storeUser'])->name('store#user');
    Route::get('/detail/{id}',[UserController::class,'detailUser'])->name('user#detail');
    Route::post('/update/{id}',[UserController::class,'updateUser'])->name('user#update');
    Route::delete('/delete/{id}',[UserController::class,'deleteUser'])->name('user#delete');
    Route::get('/login',[UserController::class,'loginUser'])->name('user#login');
});
