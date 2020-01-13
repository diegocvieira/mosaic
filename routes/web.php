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

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'AdminController@showLogin')->name('admin-show-login');
    Route::post('login', 'AdminController@sendLogin')->name('admin-send-login');

    Route::group(['middleware' => 'adminCheck'], function () {
        Route::get('index', 'AdminController@index')->name('admin-index');

        Route::get('categoria/cadastro', 'AdminController@showCategoryRegister')->name('admin-show-category-register');
        Route::post('categoria/cadastro', 'AdminController@saveCategoryRegister')->name('save-category');

        Route::get('loja/cadastro', 'AdminController@showStoreRegister')->name('admin-show-store-register');
        Route::post('loja/cadastro', 'AdminController@saveStoreRegister')->name('save-store');
    });
});
