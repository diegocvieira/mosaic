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

Route::get('lojas/filtro/categoria/{category_slug}', 'StoreController@filterCategory')->name('stores-filter-category');

Route::group(['prefix' => 'admin'], function () {
    Route::get('categoria/cadastro', 'AdminController@showCategoryRegister');
    Route::post('categoria/cadastro', 'AdminController@saveCategoryRegister')->name('save-category');

    Route::get('loja/cadastro', 'AdminController@showStoreRegister');
    Route::post('loja/cadastro', 'AdminController@saveStoreRegister')->name('save-store');
});
