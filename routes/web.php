<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products','App\Http\Controllers\ProductController@index')->name('products.index');


Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('products.create');
Route::post('/products/store', 'App\Http\Controllers\ProductController@store')->name('products.store');

Route::get('/products/show/{product}', 'App\Http\Controllers\ProductController@show')->name('products.show');

Route::get('/products/edit/{product}', 'App\Http\Controllers\ProductController@edit')->name('products.edit');
Route::put('/products/edit/{product}', 'App\Http\Controllers\ProductController@update')->name('products.update');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::delete('/products/{product}', 'App\Http\Controllers\ProductController@destroy')->name('products.destroy');

Auth::routes();