<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OfferController;
Route::group(['prefix'=>'api'],function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    Route::get('products', [ProductController::class, 'index']); 
    Route::get('products/{product}', [ProductController::class, 'show']); 
    Route::post('products', [ProductController::class, 'store']); 
    
    // Route::post('products/{product}/offers', [OfferController::class, 'store']); 
    // Route::get('products/{product}/offers', [OfferController::class, 'index']); 
});