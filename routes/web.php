<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware('preventBackHistory')->group(function(){
    Route::view('/', 'auth.login');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'preventBackHistory'])->group(function(){
    Route::prefix('user')->group(function(){
        Route::get('/table', [UserController::class, 'table'])->name('table');
    });

    Route::prefix('admin')->group(function(){
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        Route::prefix('dashboard')->group(function(){
            Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            Route::post('/users/create', [AdminController::class, 'create'])->name('user.create');
            Route::delete('/users/delete/{id}', [AdminController::class, 'destroy'])->name('user.delete');
            Route::put('/users/update/{id}', [AdminController::class, 'update'])->name('user.update');
        });
    });
});


