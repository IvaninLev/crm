<?php

use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [Controllers\HomeController::class, 'profile'])->name('profile');
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('home');


    Route::middleware("checkAdmin")->group(function () {
        Route::resource('users', Controllers\UsersController::class)->only([
            'index', 'create', 'edit', 'show'
        ]);
    });
    Route::resource('tasks', Controllers\TasksController::class)->only([
        'index', 'create', 'edit', 'show', 'destroy'
    ]);
    Route::post('/logout', [Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});



