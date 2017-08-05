<?php

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


Auth::routes();

Route::get('/', 'ProductController@getIndex')->name('product.index');
Route::get('/add-to-cart/{id}', 'ProductController@getAddToCart')->name('cart.add');
Route::get('/remove-from-cart/{id}', 'ProductController@getRemoveFromCart')->name('cart.delete');
Route::post('/update-cart', 'ProductController@postUpdateCart')->name('cart.update');
Route::get('/cart', 'ProductController@getCart')->name('cart');


Route::group(['middleware' => 'auth'], function() {
    Route::get('/orders', 'HomeController@getProfile')->name('user.profile');
    Route::get('/checkout', 'ProductController@getCheckout')->name('cart.checkout');
    Route::post('/checkout', 'ProductController@postCheckout')->name('cart.checkout');
});
