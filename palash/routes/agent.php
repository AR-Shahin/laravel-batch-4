<?php

use App\Http\Controllers\Agent\DocumentController;
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
    Route::middleware('auth:agent')->group(function(){
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

        # Document

        Route::controller(DocumentController::class)->name('document.')->prefix('document')->group(function () {
            Route::get('get-all-data', 'getAllData')->name('get-all-data');
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::delete('delete/{document}', 'destroy')->name('destroy');
            Route::get('{document}', 'show')->name('view');

            Route::post('{document}', 'update')->name('update');
        });

    });

});
