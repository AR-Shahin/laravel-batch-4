<?php

use App\Http\Controllers\Agent\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Agent\{DashboardController};

Route::prefix('agent')->as('agent.')->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest:agent')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest:agent');


    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:agent')
        ->name('logout');


    # Dash
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::middleware('auth:agent')->group(function(){



    });

});
