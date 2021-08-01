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
//$2y$10$9Z5jNVOdKgmS4A/Zs3qz9.wHwt1oEos54iP4JPXNCEIKLlkzHKJDC


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    //group for login admin
    Route::group(['prefix' => 'admin', 'namespace' => 'dashboard', 'middleware' => 'guest:admin'], function () {

        Route::get('/login', 'LoginController@login')->name('admin.login');
        Route::post('/login', 'LoginController@postlogin')->name('admin.post.login');

    });


///////////////////////////////////////////// route for dashboard admin ///////////////////////////////////////////
    Route::group(['prefix' => 'admin', 'namespace' => 'dashboard', 'middleware' => 'auth:admin'], function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');


///////////////////////////////////////////// route for dashboard admin logout
        Route::get('logout', 'LoginController@logout')->name('admin.logout');


/////////////////////////////////////////// route for admin edit profile ///////////////////////////////////////////
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'PrfileController@editprofile')->name('edit.profile');
            Route::put('update', 'PrfileController@updateprofile')->name('update.profile');
        });

/////////////////////////////////////////// route for admin categories/ //////////////////////////////////////////

        Route::group(['prefix' => 'categories'], function () {
            Route::get('/','CategoriesController@index') -> name('admin.maincategories');
            Route::get('create','CategoriesController@create') -> name('admin.maincategories.create');
            Route::post('store','CategoriesController@store') -> name('admin.maincategories.store');
            Route::get('edit/{id}','CategoriesController@edit') -> name('admin.maincategories.edit');
            Route::post('update/{id}','CategoriesController@update') -> name('admin.maincategories.update');
            Route::get('delete/{id}','CategoriesController@destroy') -> name('admin.maincategories.delete');
        });



/////////////////////////////////////////// route for admin Brands/ //////////////////////////////////////////

        Route::group(['prefix' => 'brands'], function () {
                Route::get('/','BrandsController@index') -> name('admin.brands');
            Route::get('create','BrandsController@create') -> name('admin.brands.create');
            Route::post('store','BrandsController@store') -> name('admin.brands.store');
            Route::get('edit/{id}','BrandsController@edit') -> name('admin.brands.edit');
            Route::post('update/{id}','BrandsController@update') -> name('admin.brands.update');
            Route::get('delete/{id}','BrandsController@destroy') -> name('admin.brands.delete');
        });

        /////////////////////////////////////////// route for admin tags/ //////////////////////////////////////////


        Route::group(['prefix' => 'tags'], function () {
            Route::get('/','TagsController@index') -> name('admin.tags');
            Route::get('create','TagsController@create') -> name('admin.tags.create');
            Route::post('store','TagsController@store') -> name('admin.tags.store');
            Route::get('edit/{id}','TagsController@edit') -> name('admin.tags.edit');
            Route::post('update/{id}','TagsController@update') -> name('admin.tags.update');
            Route::get('delete/{id}','TagsController@destroy') -> name('admin.tags.delete');
        });


        /////////////////////////////////////////// route for admin products/ //////////////////////////////////////////
        Route::group(['prefix' => 'Product'], function () {
            Route::get('/','ProductController@index') -> name('admin.Product');
            Route::get('product_create','ProductController@create') -> name('admin.create.Product.info');
            Route::post('Store_ProductInfo','ProductController@store') -> name('admin.store.Product.info');

            Route::get('price/{id}','ProductController@getprice') -> name('admin.create.Product.price');
            Route::post('price','ProductController@saveProductPrice') -> name('admin.store.Product.price.save');

            Route::get('stock/{id}', 'ProductController@getStock')->name('admin.products.stock');
            Route::post('stock', 'ProductController@saveProductStock')->name('admin.products.stock.store');

            Route::get('images/{id}', 'ProductController@addImages')->name('admin.products.images');

            Route::post('images', 'ProductController@saveProductImages')->name('admin.products.images.store');

            Route::post('images/save', 'ProductController@saveProductImagesDB')->name('admin.products.images.store.save');


        });

        /////////////////////////////////////////// route for admin Attribute/ //////////////////////////////////////////


        Route::group(['prefix' => 'attribute'], function () {
            Route::get('/','AttributeController@index') -> name('admin.attribute');
            Route::get('attribute_create','AttributeController@create') -> name('admin.create.attribute.info');
            Route::post('attribute_ProductInfo','AttributeController@store') -> name('admin.store.attribute.info');
            Route::get('edit/{id}','AttributeController@edit') -> name('admin.attribute.edit');
            Route::post('update/{id}','AttributeController@update') -> name('admin.attribute.update');
            Route::get('delete/{id}','AttributeController@destroy') -> name('admin.attribute.delete');


        });
        /////////////////////////////////////////// route for admin options ///////////////////////////////////////////


        Route::group(['prefix' => 'options'], function () {
            Route::get('/','OptionsController@index') -> name('admin.options');
            Route::get('create','OptionsController@create') -> name('admin.create.options');
            Route::post('optionsInfo','OptionsController@store') -> name('admin.store.options');
            Route::get('edit/{id}','OptionsController@edit') -> name('admin.options.edit');
            Route::post('update/{id}','OptionsController@update') -> name('admin.options.update');
            Route::get('delete/{id}','OptionsController@destroy') -> name('admin.options.delete');


        });

///////////////////////////////////////////// route for dashboard admin shipping setting ///////////////////////////////////////////
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingController@editShippingMethod')->name('edit.shipping.method');
            Route::put('shipping-methods/{id}', 'SettingController@updateShippingMethod')->name('update.shipping.method');
        });

    });
});







