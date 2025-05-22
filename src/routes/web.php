<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;

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
    return view('welcome');
});

Route::group(['prefix' => '/categories'], function() {
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('/', [CategoriesController::class, 'create'])->name('categories.create');
    Route::put('/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
});
