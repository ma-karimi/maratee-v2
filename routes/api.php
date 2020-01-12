<?php

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

/*Route::prefix('v1')->group(function () {
    Route::post('password/reset', 'AuthController@resetPassword');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::middleware('auth:api')->get('/user', function (Request $request) {
            return $request->user();
        });
    });
});*/


Route::delete('/{class}/multiple_delete', 'APIController@multipleDestroy');
Route::post('/{class}/hub', 'APIController@storeHub');
Route::delete('/{class}/hub', 'APIController@destroyHub');
Route::get('/{class}/constants', 'APIController@getConstants');
Route::post('/export/{class}/all', 'APIController@all');
Route::get('relations', 'APIController@relations');


Route::middleware(['auth:api'])->group(function () {
    Route::get('logout', 'AuthController@logout');
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('reset_password', 'AuthController@resetPassword');

Route::apiResource('treatments', 'TreatmentAPIController');

Route::post('paleontologies/{id}/media', 'PaleontologyAPIController@media');
Route::post('paleontologies/{id}/locality', 'PaleontologyAPIController@locality');
Route::post('paleontologies/{id}/geology-remark', 'PaleontologyAPIController@geologyAndRemark');
Route::post('paleontologies/{id}/information', 'PaleontologyAPIController@information');

Route::apiResource('paleontologies', 'PaleontologyAPIController');
Route::get('citations/all', 'CitationAPIController@all');
Route::apiResource('citations', 'CitationAPIController');
Route::apiResource('paleontology_maps', 'PaleontologyMapAPIController');


Route::get('organizations/all', 'OrganizationAPIController@all');
Route::apiResource('organizations', 'OrganizationAPIController');

Route::apiResource('departments', 'DepartmentAPIController');

Route::apiResource('locations', 'LocationAPIController');

Route::apiResource('connections', 'ConnectionAPIController');

Route::apiResource('users', 'UserAPIController');

Route::apiResource('seed_weights', 'SeedWeightAPIController');

Route::apiResource('seed_exchanges', 'SeedExchangeAPIController');

Route::get('provinces/all', 'ProvinceAPIController@all');

Route::apiResource('provinces', 'ProvinceAPIController');

Route::apiResource('protections', 'ProtectionAPIController');

Route::apiResource('projects', 'ProjectAPIController');

Route::get('products/all', 'ProductAPIController@all');
Route::apiResource('products', 'ProductAPIController');

Route::get('generals/{type}/all', 'GeneralAPIController@all');
Route::apiResource('generals', 'GeneralAPIController');

Route::get('plants/excel', 'PlantAPIController@excel');
Route::post('plants/{id}/media', 'PlantAPIController@media');
Route::apiResource('plants', 'PlantAPIController');

Route::get('herbariums/excel', 'HerbariumAPIController@excel');
Route::post('herbariums/{id}/media', 'HerbariumAPIController@media');
Route::apiResource('herbariums', 'HerbariumAPIController');

Route::apiResource('articles', 'ArticleAPIController');

Route::apiResource('article_hubs', 'ArticleHubAPIController');

Route::apiResource('evaluations', 'EvaluationAPIController');

Route::get('actors/all', 'ActorAPIController@all');
Route::apiResource('actors', 'ActorAPIController');

Route::apiResource('botanical_gardens', 'BotanicalGardenAPIController');
Route::post('botanicals/{botanical_id}/location', 'BotanicalAPIController@storeLocation');
Route::post('botanicals/{botanical_id}/information', 'BotanicalAPIController@storeInformation');
Route::post('botanicals/{botanical_id}/media', 'BotanicalAPIController@storeMedia');
Route::post('botanicals/{botanical_id}/irrigation', 'BotanicalAPIController@storeIrrigation');
Route::post('botanicals/{botanical_id}/soil', 'BotanicalAPIController@storeSoil');
Route::apiResource('botanicals', 'BotanicalAPIController');

Route::get('botanical_generals/all', 'BotanicalGeneralAPIController@all');
Route::apiResource('botanical_generals', 'BotanicalGeneralAPIController');
Route::apiResource('botanical_operations', 'BotanicalOperationAPIController');


Route::apiResource('botanical_irrigations', 'BotanicalIrrigationAPIController');


Route::apiResource('chromosomes', 'ChromosomeAPIController');

Route::get('cities/all', 'CityAPIController@all');

Route::apiResource('cities', 'CityAPIController');

Route::apiResource('constituents', 'ConstituentAPIController');
Route::apiResource('constituent_types', 'ConstituentTypeAPIController');
Route::get('countries/all', 'CountryAPIController@all');

Route::apiResource('countries', 'CountryAPIController');

Route::apiResource('cryo_banks', 'CryoBankAPIController');

Route::apiResource('internal_habitats', 'InternalHabitatAPIController');

Route::apiResource('geology_ages', 'GeologyAgeAPIController');

Route::apiResource('media', 'MediaAPIController');


Route::post('medicinal_locations/{id}/constituents', 'MedicinalLocationAPIController@storeConstituent');
Route::post('medicinal_locations/{id}/reference', 'MedicinalLocationAPIController@storeReference');
Route::post('medicinal_plants/{id}/product', 'MedicinalPlantAPIController@storeProductOrMedicine');
Route::post('medicinal_plants/{id}/applications', 'MedicinalPlantAPIController@storeApplication');
Route::apiResource('medicinal_locations', 'MedicinalLocationAPIController')->except('index', 'show');
Route::apiResource('medicinal_plants', 'MedicinalPlantAPIController');

Route::get('medicines/all', 'MedicineAPIController@all');

Route::apiResource('medicines', 'MedicineAPIController');

Route::apiResource('methods', 'MethodAPIController');

Route::apiResource('roles', 'RoleAPIController');

Route::apiResource('permissions', 'PermissionAPIController');


Route::apiResource('groups', 'GroupAPIController');

Route::apiResource('germinations', 'GerminationAPIController');

Route::apiResource('repeats', 'RepeatAPIController');

Route::get('places/all', 'PlaceAPIController@all');
Route::apiResource('places', 'PlaceAPIController');

Route::apiResource('location_hubs', 'LocationHubAPIController')->except('update', 'show');


Route::apiResource('life_forms', 'LifeFormAPIController');

Route::apiResource('medicinal_parts', 'MedicinalPartAPIController');

Route::apiResource('medicinal_plant_types', 'MedicinalPlantTypeAPIController');

Route::post('transactions/{id}/media', 'TransactionAPIController@media');
Route::apiResource('transactions', 'TransactionAPIController');

Route::get('taxonomies/excel', 'TaxonomyAPIController@excel');
Route::get('taxonomies/all', 'TaxonomyAPIController@all');
Route::delete('taxonomies/{id}/{delete}', 'TaxonomyAPIController@destroy');
Route::apiResource('taxonomies', 'TaxonomyAPIController')->except('delete');


Route::apiResource('planting_conditions', 'PlantingConditionAPIController');

//CryoBank action
Route::post('cryo_banks/{id}/determine', 'CryoBankAPIController@storeDetermine');
Route::post('cryo_banks/{id}/collect', 'CryoBankAPIController@storeCollect');
Route::post('cryo_banks/{id}/research', 'CryoBankAPIController@storeResearch');

Route::post('distribution_hubs/{$distributable_id}', 'DistributionHubAPIController@store');

Route::apiResource('permissions', 'PermissionAPIController');
Route::apiResource('geographicals', 'GeographicalAPIController');
Route::apiResource('plant_geographicals', 'PlantGeographicalAPIController')->except('update', 'edit');

Route::apiResource('roles', 'RoleAPIController');

Route::post('seed_collections/{id}/plant', 'SeedCollectionAPIController@storePlant');
Route::post('seed_collections/{id}/soil', 'SeedCollectionAPIController@storeSoil');
Route::post('seed_collections/{id}/climate', 'SeedCollectionAPIController@storeClimate');
Route::post('seed_collections/{id}/project', 'SeedCollectionAPIController@storeProject');
Route::post('seed_collections/{id}/media', 'SeedCollectionAPIController@storeMedia');
Route::apiResource('seed_collections', 'SeedCollectionAPIController');

Route::post('seed_evaluations/{id}/shoot', 'SeedEvaluationAPIController@storeShoot');
Route::post('seed_evaluations/{id}/length', 'SeedEvaluationAPIController@storeLength');
Route::post('seed_evaluations/{id}/width', 'SeedEvaluationAPIController@storeWidth');
Route::post('seed_evaluations/{id}/radical', 'SeedEvaluationAPIController@storeRadical');
Route::post('seed_evaluations/{id}/germination', 'SeedEvaluationAPIController@storeGermination');
Route::post('seed_evaluations/{id}/media', 'SeedEvaluationAPIController@storeMedia');
Route::apiResource('seed_evaluations', 'SeedEvaluationAPIController');


Route::get('seed_generals/all', 'SeedGeneralAPIController@all');
Route::resource('seed_generals', 'SeedGeneralAPIController');


Route::group(['prefix' => 'morphology'], function () {
    Route::post('qualitative_evaluations/{id}/variables', 'MorphologyQualitativeEvaluationAPIController@storeVariables');
    Route::post('quantitative_evaluations/{id}/variables', 'MorphologyQuantitativeEvaluationAPIController@storeVariables');
    Route::apiResource('qualitative_evaluations', 'MorphologyQualitativeEvaluationAPIController');

    Route::apiResource('quantitative_evaluations', 'MorphologyQuantitativeEvaluationAPIController');
    Route::apiResource('fields', 'MorphologyFieldAPIController');

});


