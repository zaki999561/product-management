<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// 商品関連のルート
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/show/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/edit/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
});


// ホーム関連のルート
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 認証ルート
Auth::routes();
