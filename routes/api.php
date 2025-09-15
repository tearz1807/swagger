<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::group([
    'middleware' => ['test'],
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->name('api.login');
    Route::get('logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('refresh', [AuthController::class, 'refresh'])->name('api.refresh');
    Route::get('me', [AuthController::class, 'me'])->name('api.me');

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
