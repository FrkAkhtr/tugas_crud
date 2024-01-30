<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

Route::get('/', LoginController::class . '@login')->name('login');
Route::get('/register', LoginController::class . '@register')->name('register');
Route::post('loginaksi', LoginController::class.'@loginaksi')->name('loginaksi');
Route::post('/register', LoginController::class . '@store')->name('register.store');
Route::get('logoutaksi', LoginController::class.'@logoutaksi')->name('logoutaksi')->middleware('auth');
Route::get('/home', ProductController::class . '@index')->name('home');
Route::get('/products/create', ProductController::class. '@create')->name('products.create');
Route::post('/products', ProductController::class. '@store')->name('products.store');
Route::get('/products/{product}', ProductController::class. '@show')->name('products.show');
Route::get('/products/{product}/edit', ProductController::class. '@edit')->name('products.edit');
Route::put('/products/{product}', ProductController::class. '@update')->name('products.update');
Route::delete('/products/{product}', ProductController::class. '@destroy')->name('products.destroy');