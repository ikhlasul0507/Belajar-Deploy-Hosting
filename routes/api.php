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
Route::apiResource('/health', App\Http\Controllers\Api\HealthController::class);
Route::apiResource('/ping', App\Http\Controllers\Api\PingController::class);

/*
|--------------------------------------------------------------------------
| API All With JWT 
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => config('constanta.prefix_url_api')
], function () {
    Route::apiResource('/userAccounts', App\Http\Controllers\Api\UserAccountController::class);
    Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
    Route::apiResource('/package', App\Http\Controllers\Api\PackageController::class);
    Route::apiResource('/accountPayment', App\Http\Controllers\Api\AccountPaymentController::class);
    Route::apiResource('/packageBuyingHistory', App\Http\Controllers\Api\PackageBuyingHistoryController::class);
    Route::apiResource('/menuParent', App\Http\Controllers\Api\MenuParentController::class);
});
