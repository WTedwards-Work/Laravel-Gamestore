<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController; 

// ==============
// CUSTOMER SIDE
// ==============
Route::get('/products', [ProductController::class, 'index']);

// CART
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/increase/{id}', [CartController::class, 'increase']);
Route::get('/cart/decrease/{id}', [CartController::class, 'decrease']);
Route::get('/cart/remove/{id}', [CartController::class, 'remove']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);


// ==================
// CHECKOUT + ORDERS 
// ==================
Route::get('/checkout', [OrderController::class, 'checkout']);
Route::get('/orders', [OrderController::class, 'index']);


// ===========
// ADMIN CRUD
// ===========
Route::get('/admin/products', [ProductController::class, 'adminIndex']);
Route::get('/admin/products/create', [ProductController::class, 'create']);
Route::post('/admin/products', [ProductController::class, 'store']);

Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']);
Route::put('/admin/products/{id}', [ProductController::class, 'update']);

Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']);