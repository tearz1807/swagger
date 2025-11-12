<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


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
    Route::get('/articles', [AdminController::class, 'getArticles']);
    Route::post('/articles', [AdminController::class, 'createArticle']);
    Route::put('/articles/{id}', [AdminController::class, 'updateArticle']);
    Route::delete('/articles/{id}', [AdminController::class, 'deleteArticle']);
    Route::post('/articles/{id}/toggle-publish', [AdminController::class, 'togglePublish']);
});
