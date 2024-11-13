<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;


Route::post('register', [JWTAuthController::class, 'register'])->withoutMiddleware([JwtMiddleware::class]);
Route::post('login', [JWTAuthController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', [JWTAuthController::class, 'getUser']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
});