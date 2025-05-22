<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('product.index'));

Route::resource('product', ProductController::class)->except('show');
Route::resource('order', OrderController::class)->except('show');

Route::get('order/{order}/complete', [OrderController::class, 'complete'])->name('order.complete');
