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
Route::prefix('/cate')->group(function(){
    Route::get('index','CategoryController@index');
    Route::get('create','CategoryController@create');
    Route::post('store','CategoryController@store');
    Route::get('edit/{id}','CategoryController@edit');
    Route::post('update/{id}','CategoryController@update');
    Route::get('destroy/{id}','CargoryController@destroy');

 });
