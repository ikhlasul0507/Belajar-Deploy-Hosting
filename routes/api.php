<?php

use Illuminate\Support\Facades\Route;
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
| API Helth
|--------------------------------------------------------------------------
*/
// Route::post('/health', App\Http\Controllers\Api\RegisterController::class)->name('register');

/*
|--------------------------------------------------------------------------
| API All With JWT 
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'halo'
], function () {
    Route::apiResource('/userAccounts', App\Http\Controllers\Api\UserAccountController::class);
    Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
});
