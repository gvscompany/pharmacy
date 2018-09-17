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
})->name('home.page');


Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function () {
    Route::resource('/dashboard', 'Admin\AdminController')->only('index');

    // Manufacturer
    Route::get('/manufacturer/trash', ['uses'=>'Admin\ManufacturerController@trash', 'as'=>'manufacturer.trash']);
    Route::get('/manufacturer/restore/{id}', ['uses'=>'Admin\ManufacturerController@restore', 'as'=>'manufacturer.restore'])->where(['id'=>'[\d]+']);
    Route::delete('/manufacturer/delete/{id}', ['uses'=>'Admin\ManufacturerController@delete', 'as'=>'manufacturer.delete'])->where(['id'=>'[\d]+']);
    Route::resource('/manufacturer', 'Admin\ManufacturerController')->except('show');

    // Purpose
    Route::get('/purpose/trash', ['uses'=>'Admin\PurposeController@trash', 'as'=>'purpose.trash']);
    Route::get('/purpose/restore/{id}', ['uses'=>'Admin\PurposeController@restore', 'as'=>'purpose.restore'])->where(['id'=>'[\d]+']);
    Route::delete('/purpose/delete/{id}', ['uses'=>'Admin\PurposeController@delete', 'as'=>'purpose.delete'])->where(['id'=>'[\d]+']);
    Route::resource('/purpose', 'Admin\PurposeController')->except('show');

    // Medicine
    Route::get('/product/trash', ['uses'=>'Admin\ProductController@trash', 'as'=>'product.trash']);
    Route::get('/product/restore/{id}', ['uses'=>'Admin\ProductController@restore', 'as'=>'product.restore'])->where(['id'=>'[\d]+']);
    Route::delete('/product/delete/{id}', ['uses'=>'Admin\ProductController@delete', 'as'=>'product.delete'])->where(['id'=>'[\d]+']);
    Route::resource('/product', 'Admin\ProductController');
});
Auth::routes();
