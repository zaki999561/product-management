<?php


use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::post('/purchase', [SalesController::class, 'purchase']);