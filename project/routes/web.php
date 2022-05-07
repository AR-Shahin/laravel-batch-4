<?php

use App\Models\Post;
use App\Models\Product;
// use Barryvdh\DomPDF\PDF;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;



Route::get('/pdf', function () {
    $data['product'] = Product::get();
    $pdf = PDF::loadView('pdf', $data);
    return $pdf->download('abc.pdf');
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/debug', function () {
    $data = Product::get();
    return view('debug', compact('data'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin_auth.php';
