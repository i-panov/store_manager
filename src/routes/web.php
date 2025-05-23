<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => '/categories'], function() {
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('/', [CategoriesController::class, 'create'])->name('categories.create');
    Route::put('/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
});

Route::group(['prefix' => '/products'], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
    Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
});

Route::group(['prefix' => '/orders'], function() {
    Route::get('/', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/create', [OrdersController::class, 'create'])->name('orders.create');
    Route::post('/', [OrdersController::class, 'store'])->name('orders.store');
    Route::get('/{id}', [OrdersController::class, 'show'])->name('orders.show');
    Route::get('/{id}/edit', [OrdersController::class, 'edit'])->name('orders.edit');
    Route::put('/{id}', [OrdersController::class, 'update'])->name('orders.update');
    Route::delete('/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
});
