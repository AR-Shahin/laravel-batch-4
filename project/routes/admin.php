<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function () {
});

Route::get('/admin', function () {
    return view('backend.auth.login');
});
