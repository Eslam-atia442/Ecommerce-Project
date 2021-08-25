<?php

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

Auth::routes();
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',]
    ], function () {

    Route::group(['namespace' => 'Site', 'middleware' => 'verifiedCodePhone'], function () {

    Route::get('/', 'HomeController@home')->name('home');
        route::get('category/{slug}', 'CategoryController@productsBySlug')->name('category');
        route::get('product/{slug}', 'ProductController@productsBySlug')->name('product.details');


     // Cart routes

        Route::group(['prefix' => 'cart'], function () {
            Route::get('/', 'CartController@getIndex')->name('site.cart.index');
            Route::post('/cart/add/{slug?}', 'CartController@postAdd')->name('site.cart.add');
            Route::post('/update/{slug}', 'CartController@postUpdate')->name('site.cart.update');
            Route::post('/update-all', 'CartController@postUpdateAll')->name('site.cart.update-all');
        });
    });


    Route::group(['namespace' => 'Site','middleware' => 'auth'], function () {


        Route::get('/profile', function () {return('profile');})->name('profile')->middleware('verifiedCodePhone');
        Route::get('verify', function () {return view('auth.verification');})-> name('verification.form');
        Route::post('verify-user', 'CodeVerifyController@verify')->name('verify-user');



        Route::get('payment/{amount}', 'PaymentController@getPayments') -> name('payment');
        Route::post('payment', 'PaymentController@processPayment') -> name('payment.process');




    });

    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {


        Route::post('wishlist', 'WishlistController@store')->name('wishlist.store');
        Route::delete('wishlist', 'WishlistController@destroy')->name('wishlist.destroy');
        Route::get('yourwishlist', 'WishlistController@index')->name('wishlist.products.index');
    });



});



