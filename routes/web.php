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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('goods')->group(function(){
    Route::get('create','GoodsController@create');
    Route::post('store','GoodsController@store');
    Route::get('index','GoodsController@index');
    Route::get('destroy/{id}','GoodsController@destroy');
    Route::get('edit/{id}','GoodsController@edit');
    Route::post('update/{id}','GoodsController@update');
});

Route::prefix('brand')->group(function(){
	Route::get('create','BrandController@create');
	Route::post('store','BrandController@store');
	Route::get('index','BrandController@index');
	Route::get('edit/{id}','BrandController@edit');
	Route::post('update/{id}','BrandController@update');
	Route::get('destroy/{id}','BrandController@destroy');
});