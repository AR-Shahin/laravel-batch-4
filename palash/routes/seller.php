<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\Auth\{
    RegisteredUserController,
    AuthenticatedSessionController,
};
use App\Http\Controllers\Seller\{AgentController, DashboardController};

Route::prefix('seller')->as('seller.')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest:seller')
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest:seller')->name('store');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest:seller')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest:seller');


    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:seller')
        ->name('logout');


    # Dash
    Route::middleware('auth:seller')->group(function(){
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

        # Agent
        Route::controller(AgentController::class)->prefix('agent')->name('agent.')->group(function(){
            Route::get('index','index')->name('index');
            Route::get('create','create')->name('create');
            Route::post('store','store')->name('store');
            Route::delete('delete/{admin}','delete')->name('delete');
        });

    });

});
