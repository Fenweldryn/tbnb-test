<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Product;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('products', Product\Index::class)->name('products');
    Route::get('products/create', Product\Create::class)->name('products.create');
    Route::get('products/{product:slug}/edit', Product\Edit::class)->name('products.edit');
    Route::get('products/{product:slug}/show', Product\Show::class)->name('products.show');
});
