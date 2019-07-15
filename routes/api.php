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
    Route::post('/register', 'AuthController@register');
    Route::post('password/reset', 'AuthController@resetPassword');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::resource('continents', 'ContinentAPIController');
        Route::resource('treatments', 'TreatmentAPIController');
        Route::resource('paleontologies', 'PaleontologyAPIController');
        Route::apiResource('organizations', 'OrganizationAPIController');
        Route::apiResource('departments', 'DepartmentAPIController');
        Route::apiResource('locations', 'LocationAPIController');
        Route::apiResource('connections', 'ConnectionAPIController');
        Route::middleware('auth:api')->get('/user', function (Request $request) {
            return $request->user();
        });
    });
});
