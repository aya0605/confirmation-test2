<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeasonController;

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

Route::get('/products', [ProductController::class, 'index'])->name('products.index'); 
Route::get('/products/register', [ProductController::class, 'create'])->name('products.create'); 
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); 
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search'); 


Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit'); 
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('products.update'); 
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show'); 


Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons.index');
Route::get('/seasons/create', [SeasonController::class, 'create'])->name('seasons.create');
Route::post('/seasons', [SeasonController::class, 'store'])->name('seasons.store');
Route::get('/seasons/{season}', [SeasonController::class, 'show'])->name('seasons.show');
Route::get('/seasons/{season}/edit', [SeasonController::class, 'edit'])->name('seasons.edit');
Route::put('/seasons/{season}', [SeasonController::class, 'update'])->name('seasons.update');
Route::patch('/seasons/{season}', [SeasonController::class, 'update']); 
Route::delete('/seasons/{season}', [SeasonController::class, 'destroy'])->name('seasons.destroy');