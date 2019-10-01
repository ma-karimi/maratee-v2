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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('convert')->group(function (){
    Route::get('convert', 'IndexConvertController@handle')->name('convert.index');
    Route::post('convert', 'ConvertController@handle')->name('convert.convert');
    Route::post('convert/rollback', 'RollbackConvertController@handle')->name('convert.rollback');
});


Route::get('test','TestController@handle');

