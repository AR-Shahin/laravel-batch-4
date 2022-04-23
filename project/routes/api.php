<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\JWTAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('posts')->middleware('auth:sanctum')->controller(PostController::class)->group(function () {

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('view/{id}', 'show');
    Route::post('/update/{id}', 'update');
    Route::post('/delete/{id}', 'delete');
});


Route::prefix('users')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});


# Product

Route::prefix('products')->middleware('auth:jwt_auth')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
});


# JWT Auth
Route::controller(JWTAuthController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:jwt_auth')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'me');
    });
});
