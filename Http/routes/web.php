<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [DashboardController::class, 'viewLogin']);
Route::get('/register', function () {
    return view('register');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/create', function () {
    return view('create');
});


Route::post('/delete/{id}', [DashboardController::class, 'delete'])->name('delete');
Route::get('/home', [DashboardController::class, 'index']);
Route::post('/store', [DashboardController::class, 'store']);
Route::post('/auth', [DashboardController::class, 'handleLogin']);
Route::post('/store-user', [DashboardController::class, 'handleRegister']);
Route::post('/logout', [DashboardController::class, 'logout']);
