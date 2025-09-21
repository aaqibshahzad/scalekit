<?php

use Illuminate\Support\Facades\Route;
use AaqibShahzad\ScaleKit\Http\Controllers\SocialAuthController;
use AaqibShahzad\ScaleKit\Http\Controllers\AuthController;

Route::prefix('scalekit')->group(function () {
    
    // OAuth redirect & callback
    Route::get('oauth/{provider}/redirect', [SocialAuthController::class, 'redirect']);
    Route::get('oauth/{provider}/callback', [SocialAuthController::class, 'callback']);

    // Optional API auth endpoints
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});