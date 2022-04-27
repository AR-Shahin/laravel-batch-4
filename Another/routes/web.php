<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


Route::controller(HomeController::class)->group(function () {

    Route::get('home', 'index');
    Route::get('login', 'login');
    Route::get('register', 'register');
    Route::post('auth', 'handleLogin');
    Route::post('store', 'handleRegister');
    Route::post('logout', 'logout');
});
