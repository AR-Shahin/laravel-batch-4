<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    CategoryController,DashboardController, PostController, SubcategoryController
};
use App\Models\Admin;

Route::prefix('admin')->as('admin.')->middleware(['auth:admin'])->group(function () {

    Route::controller(AdminController::class)->group(function(){
        Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::delete('delete/{admin}','delete')->name('delete');
    });

    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(CategoryController::class)->name('category.')->prefix('category')->group(function () {
        Route::get('get-all-data', 'getAllData')->name('get-all-data');
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::delete('{category}', 'destroy')->name('destroy');
        Route::get('{category}', 'show')->name('view');

        Route::post('{category}', 'update')->name('update');
    });

    # Sub Category
    Route::controller(SubcategoryController::class)->name('sub-category.')->prefix('sub-category')->group(function () {
        Route::get('get-all-data', 'getAllData')->name('get-all-data');
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::delete('{category}', 'destroy')->name('destroy');
        Route::get('{category}', 'show')->name('view');
        Route::post('{category}', 'update')->name('update');
    });


    # Post
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function () {
        // Route::post('update{post}', 'update')->name('update');
        Route::post('update/{post}','update')->name('update');
        Route::get('/', 'index')->name('index');
        Route::get('all/{category}', 'getSubCat');
        Route::get('create', 'create')->name('create');
        Route::get('show/{post}', 'show')->name('show');
        Route::post('store', 'store')->name('store');
        Route::delete('{post}', 'destroy')->name('destroy');

        Route::get('edit/{post}', 'edit')->name('edit');
    });

   
});
