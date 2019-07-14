<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {


    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/register', 'RegisterController@create');
    Route::namespace('Api')->group(function () {
        Route::middleware('auth:api')->get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/register', 'AuthController@register');
        Route::post('password/reset', 'AuthController@resetPassword');
        Route::group(['middleware' => ['auth:api'], 'namespace' => 'Api'], function () {
        });
    });
});
Route::resource('continents', 'ContinentAPIController');
Route::resource('treatments', 'TreatmentAPIController');
Route::resource('paleontologies', 'PaleontologyAPIController');
Route::resource('connections', 'ConnectionAPIController');
Route::resource('departments', 'DepartmentAPIController');
Route::resource('locations', 'LocationAPIController');
Route::resource('organizations', 'OrganizationAPIController');