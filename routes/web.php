<?php

use App\Cart;
use App\Product;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::prefix('/api')->group(function (){

    Route::get('/app', 'AppController@index')->name('api.app');

    Route::get('/cart', 'CartController@show')->name('api.cart');

    Route::delete('/cart/remove', 'CartController@destroy')->name('api.cart.remove');
    Route::put('/cart/add', 'CartController@store')->name('api.cart.add');
    Route::post('/cart/increase', 'CartController@store')->name('api.cart.increase');
    Route::post('/cart/reduce', 'CartController@reduce')->name('api.cart.reduce');
    Route::post('/cart/clear', 'CartController@clear')->name('api.cart.clear');
    Route::post('/cart/delivery', 'CartController@delivery')->name('api.cart.delivery');
    Route::post('/cart/checkout', 'CartController@checkout')->name('api.cart.checkout');
});

Route::get('/home', 'HomeController@index')->name('home');
