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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'lojas'], function () {
    Route::get('/', 'StoreController@list')->name('stores-list');

    Route::get('filtro/categoria/{category_slug?}', 'StoreController@filterCategory')->name('stores-filter-category');

    Route::get('ativar/{store_id}', 'StoreController@activate')->name('store-activate');
    Route::get('desativar/{store_id}', 'StoreController@desactivate')->name('store-desactivate');

    Route::post('sugerir', 'StoreController@suggest')->name('store-suggest');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('login', 'AdminController@showLogin')->name('login');
    Route::post('login', 'AdminController@login')->name('login');

    Route::group(['middleware' => 'adminCheck'], function () {
        Route::get('index', 'AdminController@index')->name('index');

        Route::group(['prefix' => 'lojas', 'as' => 'store.'], function () {
            Route::get('/', 'StoreController@index')->name('index');

            Route::get('cadastrar', 'StoreController@create')->name('create');
            Route::post('cadastrar', 'StoreController@store')->name('store');

            Route::get('editar/{id}', 'StoreController@edit')->name('edit');
            Route::put('editar/{id}', 'StoreController@update')->name('update');

            Route::get('deletar/{id}', 'StoreController@destroy')->name('destroy');
        });

        Route::group(['prefix' => 'categorias', 'as' => 'category.'], function () {
            Route::get('/', 'CategoryController@index')->name('index');

            Route::get('cadastrar', 'CategoryController@create')->name('create');
            Route::post('cadastrar', 'CategoryController@store')->name('store');

            Route::get('editar/{id}', 'CategoryController@edit')->name('edit');
            Route::put('editar/{id}', 'CategoryController@update')->name('update');

            Route::get('deletar/{id}', 'CategoryController@destroy')->name('destroy');
        });
    });
});
