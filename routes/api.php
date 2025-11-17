<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ArticleController;


Route::group([
    'middleware' => ['test'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('api.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('api.refresh');
    Route::get('me', [AuthController::class, 'me'])->name('api.me');
    Route::post('register', [AuthController::class, 'register'])->name('api.register');
});


Route::group([
    'middleware' => ['test'],
    'prefix' => 'user'
], function ($router) {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::group([
    'middleware' => ['test', 'admin'],
    'prefix' => 'admin'
], function ($router) {
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
    Route::post('/articles/{id}/toggle-publish', [ArticleController::class, 'togglePublish']);
});
