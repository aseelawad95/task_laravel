<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('register', [AuthController::class, 'showRegisterForm'])->name('showRegister');

Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'checkSeller'], function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products', [ProductController::class, 'show']);
    Route::get('/create-product', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    
});
