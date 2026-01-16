<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::group(['prefix' => 'tasks', 'middleware' => 'auth:sanctum'], function () {
    Route::post('create', [TasksController::class, 'store']);
    Route::post('edit/{task}', [TasksController::class, 'update']);
    Route::post('{task}/complete', [TasksController::class, 'complete']);
    Route::delete('destroy/{task}', [TasksController::class, 'destroy']);
});
Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::post('create', [UsersController::class, 'store']);
    Route::post('update/{user}', [UsersController::class, 'update']);
});


