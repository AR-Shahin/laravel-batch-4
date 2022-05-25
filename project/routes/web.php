<?php

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\PolicyController;
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


Route::get('gate', [AuthorizationController::class, 'index'])->name('gate')->middleware(['can:isAdmin']);


Route::get('policy', [PolicyController::class, 'index']);
// Route::get('product/{product}', [PolicyController::class, 'show'])->name('view')->middleware('can:view,product');
Route::get('product/{product}', [PolicyController::class, 'show'])->name('view');
