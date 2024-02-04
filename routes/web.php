<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserControlller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing page
Route::get('/', [ProductController::class, 'main'])->name('product.main');
Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');


// User Manager
Route::prefix('/users')->group(function () {
    Route::get('/', [UserControlller::class, 'index'])->name('index.user');
    Route::post('/add', [UserControlller::class, 'store'])->name('add.user');
    Route::get('/edit/{id}', [UserControlller::class, 'edit'])->name('edit.user');
    Route::put('/edit/{id}', [UserControlller::class, 'update'])->name('update.user');
    Route::delete('/delete/{id}', [UserControlller::class, 'destroy'])->name('delete.user');
});

// Category Manager
Route::prefix('/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/add', [CategoryController::class, 'store'])->name('category.add');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
});

// Product Manager
Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::post('/add', [ProductController::class, 'store'])->name('product.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/edit/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

