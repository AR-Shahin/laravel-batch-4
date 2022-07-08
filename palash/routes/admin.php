<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    CategoryController,DashboardController, PostController, SubcategoryController
};
use App\Models\Admin;

Route::prefix('admin')->as('admin.')->middleware(['auth:admin'])->group(function () {


    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('seller', [DashboardController::class, 'seller'])->name('seller');
    Route::get('sellers/{seller}', [DashboardController::class, 'sellerWithAgents'])->name('agents');
    Route::delete('sellers/{seller}', [DashboardController::class, 'delete'])->name('delete');




});
