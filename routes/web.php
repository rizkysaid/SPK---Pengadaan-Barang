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
    return view('layouts.master');
});

Route::resource('/kategori', 'KategoriController')->except([
	'create', 'show'
]);

Route::resource('/satuan', 'SatuanController')->except([
	'create', 'show'
]);

Route::resource('/barang', 'BarangController')->except([
	'create', 'show'
]);


Route::group(['prefix' => 'eoq'], function(){
	Route::get('/', 'EoqController@index');
	Route::post('store', 'EoqController@store');
	Route::get('get-barang/{id}', 'BarangController@getBarang');
});

