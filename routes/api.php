<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CityController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\IndexController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\CountryController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\API\V1\AttributeController;
use App\Http\Controllers\API\V1\CategegoryController;
use App\Http\Controllers\API\V1\DeliveryInfoController;


//register
Route::post('register', [RegisterController::class, 'register']);
//login
Route::post('login', [RegisterController::class, 'login']);
//
Route::get('category-list', [IndexController::class, 'category_list'])->name('category_list');
Route::get('product-list', [IndexController::class, 'product_list'])->name('product_list');
Route::get('products/{slug}', [IndexController::class, 'product_details'])->name('product_details');
Route::resource('delivery-info', DeliveryInfoController::class);
     
Route::middleware('auth:api')->group( function () {
    //category
    Route::resource('categories', CategegoryController::class);
    //country
    Route::resource('countries', CountryController::class);
    //city
    Route::resource('cities', CityController::class);
    //attribute
    Route::resource('attributes', AttributeController::class);
    //user
    Route::resource('users', UserController::class);
    //product
    Route::resource('products', ProductController::class);
    //order
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    //logout
    Route::get('/user', [RegisterController::class, 'user']);
    Route::post('logout', [RegisterController::class, 'logout']);
});