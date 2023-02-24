<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
/*
|--------------------------------------------------------------------------
| API Auth
|--------------------------------------------------------------------------
*/
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

/*
|--------------------------------------------------------------------------
| API All With JWT 
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'halo'
], function ($router) {
    Route::apiResource('/userAccounts', App\Http\Controllers\Api\UserAccountController::class);
    Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
});
