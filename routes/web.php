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

Route::view('admin', 'admin.auth.login');
Route::post('admin', 'AdminAuth\AuthController@login');
Route::get('admin/logout', 'AdminAuth\AuthController@logout');