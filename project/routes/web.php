<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/admin', function () {
    return view('backend.auth.login');
});
