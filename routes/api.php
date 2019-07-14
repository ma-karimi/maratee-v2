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
    Route::group(['middleware' => ['auth:api'], 'namespace' => 'Api'], function () {
        Route::middleware('auth:api')->get('/user', function (Request $request) {
            return $request->user();
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

Route::resource('paleontologies', 'PaleontologyAPIController');

Route::resource('soil_features', 'SoilFeatureAPIController');

Route::resource('soils', 'SoilAPIController');

Route::resource('visits', 'VisitAPIController');

Route::resource('villages', 'VillageAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('technology_collections', 'TechnologyCollectionAPIController');

Route::resource('soil_has_soil_features', 'SoilHasSoilFeatureAPIController');

Route::resource('seed_weights', 'SeedWeightAPIController');

Route::resource('seed_technologies', 'SeedTechnologyAPIController');

Route::resource('seed_plants', 'SeedPlantAPIController');

Route::resource('seed_moleculars', 'SeedMolecularAPIController');

Route::resource('seed_hubs', 'SeedHubAPIController');

Route::resource('seed_has_plants', 'SeedHasPlantAPIController');

Route::resource('seed_exchanges', 'SeedExchangeAPIController');

Route::resource('seed_chemicals', 'SeedChemicalAPIController');

Route::resource('seeds', 'SeedAPIController');

Route::resource('reproductions', 'ReproductionAPIController');

Route::resource('regions', 'RegionAPIController');

Route::resource('provinces', 'ProvinceAPIController');

Route::resource('protections', 'ProtectionAPIController');

Route::resource('projects', 'ProjectAPIController');

Route::resource('products', 'ProductAPIController');

Route::resource('plantologies', 'PlantologyAPIController');

Route::resource('planting_actions', 'PlantingActionAPIController');

Route::resource('planting_generals', 'PlantingGeneralAPIController');

Route::resource('planting_factors', 'PlantingFactorAPIController');

Route::resource('planting_applications', 'PlantingApplicationAPIController');

Route::resource('plants', 'PlantAPIController');

Route::resource('paleontology_media', 'PaleontologyMediaAPIController');

Route::resource('paleontology_citations', 'PaleontologyCitationAPIController');

Route::resource('paleontology_actions', 'PaleontologyActionAPIController');

Route::resource('paleontologies', 'PaleontologyAPIController');

Route::resource('organizations', 'OrganizationAPIController');

Route::resource('morphologies', 'MorphologyAPIController');