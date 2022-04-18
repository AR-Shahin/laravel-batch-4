<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SocialLoginController;


Route::prefix('admin')->name('admin.')->group(function () {
});

Route::get('/admin', function () {
    return view('backend.auth.login');
});


Route::get('/auth/redirect/{provider}', [SocialLoginController::class, 'login'])->name(('social.login'));
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('social.callback');
