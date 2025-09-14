<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::group([

    'middleware' => ['api', 'test'],
    'prefix' => 'auth'

], function ($router) {

    Route::any('login', [AuthController::class, 'login'])->name('api.login');
    Route::any('logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::any('refresh', [AuthController::class, 'refresh'])->name('api.refresh');
    Route::any('me', [AuthController::class, 'me'])->name('api.me');

});


Route::group([
    'middleware' => ['auth:api', 'test'],
    'prefix' => 'user'
], function ($router) {

    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);

});
