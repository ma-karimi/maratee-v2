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


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ImportExcelAPIController;
use Illuminate\Support\Facades\Route;

Route::post('password/reset', 'AuthController@resetPassword');

/*Route::prefix('v1')->group(function () {

    Route::group(['middleware' => ['auth:api']], function () {

        Route::middleware('auth:api')->get('/user', function (Request $request) {
            return $request->user();
        });
    });
});*/

Route::get('/home/data', 'HomeAPIController@data');
Route::get('/home', 'HomeAPIController@index');
Route::get('captcha', [AuthController::class,'captcha']);
Route::post('login', [AuthController::class,'login']);

//Route::get('/captcha', 'AuthController@captcha');

Route::middleware(['auth:api'])->group(function () {

    Route::delete('/{class}/{id}/{delete?}', 'APIController@destroy');
    Route::delete('/{class}/multiple_delete', 'APIController@multipleDestroy');
    Route::post('/{class}/hub', 'APIController@storeHub');
    Route::delete('/{class}/hub', 'APIController@destroyHub');
    Route::get('/{class}/constants', 'APIController@getConstants');
    Route::post('/export/{class}/all', 'APIController@all');
    Route::get('relations', 'APIController@relations');

    Route::get('user', 'AuthController@user');
    Route::post('change/password', 'AuthController@password');
    Route::post('user', 'AuthController@update');
    Route::get('logout', 'AuthController@logout');
    Route::patch('audits/{id}', 'AuditAPIController@update');

    Route::apiResource('treatments', 'TreatmentAPIController');
    Route::get('journals/all', 'JournalAPIController@all');
    Route::apiResource('journals', 'JournalAPIController');

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

    Route::apiResource('locations', 'LocationAPIController');

    Route::apiResource('users', 'UserAPIController');

    Route::apiResource('seed_weights', 'SeedWeightAPIController')->except('destroy');

    Route::apiResource('seed_exchanges', 'SeedExchangeAPIController');

    Route::get('provinces/all', 'ProvinceAPIController@all');

    Route::apiResource('provinces', 'ProvinceAPIController');

    Route::apiResource('protections', 'ProtectionAPIController');

    Route::apiResource('projects', 'ProjectAPIController');

    Route::post('products/{id}/media', 'ProductAPIController@media');
    Route::get('products/all', 'ProductAPIController@all');
    Route::apiResource('products', 'ProductAPIController')->except('destroy');

    Route::get('generals/{type}/all', 'GeneralAPIController@type');
    Route::get('generals/all', 'GeneralAPIController@all');
    Route::apiResource('generals', 'GeneralAPIController');

    Route::get('nonflower_generals/{type}/all', 'NonflowerGeneralAPIController@type');
    Route::get('nonflower_generals/all', 'NonflowerGeneralAPIController@all');
    Route::apiResource('nonflower_generals', 'NonflowerGeneralAPIController');

    Route::get('paleobotany_generals/all', 'PaleobotanyGeneralAPIController@all');
    Route::apiResource('paleobotany_generals', 'PaleobotanyGeneralAPIController');
    Route::get('paleobotany_taxonomies/all', 'PaleobotanyTaxonomyAPIController@all');
    Route::apiResource('paleobotany_taxonomies', 'PaleobotanyTaxonomyAPIController');

    Route::get('plants/excel', 'PlantAPIController@excel');
    Route::post('plants/{id}/media', 'PlantAPIController@media');
    Route::apiResource('plants', 'PlantAPIController')->except('destroy');

    Route::get('herbariums/excel', 'HerbariumAPIController@excel');
    Route::post('herbariums/{id}/media', 'HerbariumAPIController@media');
    Route::apiResource('herbariums', 'HerbariumAPIController')->except('destroy');

    Route::post('nonflowers/{id}/media', 'NonflowerAPIController@media');
    Route::apiResource('nonflowers', 'NonflowerAPIController')->except('destroy');

    Route::get('actors/all', 'ActorAPIController@all');
    Route::apiResource('actors', 'ActorAPIController');

    Route::apiResource('botanical_gardens', 'BotanicalGardenAPIController');
    Route::post('botanicals/{botanical_id}/location', 'BotanicalAPIController@storeLocation');
    Route::post('botanicals/{botanical_id}/information', 'BotanicalAPIController@storeInformation');
    Route::post('botanicals/{botanical_id}/media', 'BotanicalAPIController@storeMedia');
    Route::post('botanicals/{botanical_id}/irrigation', 'BotanicalAPIController@storeIrrigation');
    Route::post('botanicals/{botanical_id}/soil', 'BotanicalAPIController@storeSoil');
    Route::apiResource('botanicals', 'BotanicalAPIController')->except('destroy');

    Route::get('botanical_generals/all', 'BotanicalGeneralAPIController@all');
    Route::apiResource('botanical_generals', 'BotanicalGeneralAPIController');
    Route::apiResource('botanical_operations', 'BotanicalOperationAPIController');


    Route::apiResource('botanical_irrigations', 'BotanicalIrrigationAPIController');


    Route::apiResource('chromosomes', 'ChromosomeAPIController');

    Route::get('cities/all', 'CityAPIController@all');

    Route::apiResource('cities', 'CityAPIController');

    Route::apiResource('constituents', 'ConstituentAPIController');
    Route::get('constituent_types/all', 'ConstituentTypeAPIController@all');
    Route::apiResource('constituent_types', 'ConstituentTypeAPIController');
    Route::get('countries/all', 'CountryAPIController@all');

    Route::apiResource('countries', 'CountryAPIController');
    Route::post('cryo_banks/{id}/media', 'CryoBankAPIController@media');

    Route::apiResource('cryo_banks', 'CryoBankAPIController');

    Route::apiResource('internal_habitats', 'InternalHabitatAPIController');

    Route::apiResource('geology_ages', 'GeologyAgeAPIController');

    Route::apiResource('media', 'MediaAPIController');


    Route::post('medicinal_locations/{id}/constituents', 'MedicinalLocationAPIController@storeConstituent');
    Route::post('medicinal_locations/{id}/reference', 'MedicinalLocationAPIController@storeReference');
    Route::apiResource('medicinal_locations', 'MedicinalLocationAPIController')->except('destroy');
    Route::apiResource('medicinal_plants', 'MedicinalPlantAPIController')->except('destroy');
    Route::apiResource('medicinal_applications', 'MedicinalApplicationAPIController')->except('destroy');

    Route::post('medicines/{id}/media', 'MedicineAPIController@media');
    Route::get('medicines/all', 'MedicineAPIController@all');

    Route::apiResource('medicines', 'MedicineAPIController');

    Route::apiResource('methods', 'MethodAPIController');

    Route::apiResource('roles', 'RoleAPIController');

    Route::apiResource('permissions', 'PermissionAPIController');

    Route::get('places/all', 'PlaceAPIController@all');
    Route::apiResource('places', 'PlaceAPIController');

    Route::apiResource('location_hubs', 'LocationHubAPIController')->except('update', 'show');


    Route::apiResource('life_forms', 'LifeFormAPIController');

    Route::apiResource('medicinal_parts', 'MedicinalPartAPIController');

    Route::get('medicinal_plant_types/all', 'MedicinalPlantTypeAPIController@all');
    Route::apiResource('medicinal_plant_types', 'MedicinalPlantTypeAPIController');

    Route::post('transactions/{id}/media', 'TransactionAPIController@media');
    Route::apiResource('transactions', 'TransactionAPIController');

    Route::get('taxonomies/excel', 'TaxonomyAPIController@excel');
    Route::get('taxonomies/all', 'TaxonomyAPIController@all');
//Route::delete('taxonomies/{id}/{delete}', 'TaxonomyAPIController@destroy');
    Route::apiResource('taxonomies', 'TaxonomyAPIController')->except('destroy');

    Route::get('nonflower_taxonomies/all', 'NonflowerTaxonomyAPIController@all');
    Route::apiResource('nonflower_taxonomies', 'NonflowerTaxonomyAPIController')->except('destroy');


//CryoBank action
    Route::post('cryo_banks/{id}/determine', 'CryoBankAPIController@storeDetermine');
    Route::post('cryo_banks/{id}/collect', 'CryoBankAPIController@storeCollect');
    Route::post('cryo_banks/{id}/research', 'CryoBankAPIController@storeResearch');

    Route::post('distribution_hubs/{$distributable_id}', 'DistributionHubAPIController@store');

    Route::apiResource('permissions', 'PermissionAPIController');
    Route::apiResource('distributions', 'DistributionAPIController');
    Route::apiResource('geographicals', 'GeographicalAPIController');
    Route::apiResource('plant_geographicals', 'PlantGeographicalAPIController')->except('update', 'edit');
    Route::apiResource('cryobank_generals', 'CryobankGeneralAPIController')->except('update', 'edit');

    Route::apiResource('roles', 'RoleAPIController');

    Route::post('seed_collections/{id}/plant', 'SeedCollectionAPIController@storePlant');
    Route::post('seed_collections/{id}/soil', 'SeedCollectionAPIController@storeSoil');
    Route::post('seed_collections/{id}/climate', 'SeedCollectionAPIController@storeClimate');
    Route::post('seed_collections/{id}/project', 'SeedCollectionAPIController@storeProject');
    Route::post('seed_collections/{id}/media', 'SeedCollectionAPIController@storeMedia');
    Route::apiResource('seed_collections', 'SeedCollectionAPIController')->except('destroy');

//Route::post('seed_evaluations/{id}/shoot', 'SeedEvaluationAPIController@storeShoot');
//Route::post('seed_evaluations/{id}/length', 'SeedEvaluationAPIController@storeLength');
//Route::post('seed_evaluations/{id}/width', 'SeedEvaluationAPIController@storeWidth');
//Route::post('seed_evaluations/{id}/radical', 'SeedEvaluationAPIController@storeRadical');
    Route::post('seed_evaluations/{id}/germination-values', 'SeedEvaluationAPIController@storeGerminationValues');
//    Route::post('seed_evaluations/{id}/value', 'SeedEvaluationAPIController@storeValues');
    Route::post('seed_evaluations/{id}/germination', 'SeedEvaluationAPIController@storeGermination');
    Route::post('seed_evaluations/{id}/media', 'SeedEvaluationAPIController@storeMedia');
    Route::apiResource('seed_evaluations', 'SeedEvaluationAPIController')->except('destroy');


    Route::get('seed_generals/all', 'SeedGeneralAPIController@all');
    Route::apiResource('seed_generals', 'SeedGeneralAPIController');

    Route::apiResource('morphology_fields', 'SeedMorphologyFieldAPIController');

    Route::post('seed_morphologies/{id}/quantity', 'SeedMorphologyAPIController@storeQuantity');
//    Route::post('seed_morphologies/{id}/field', 'SeedMorphologyAPIController@storeField');
    Route::post('seed_morphologies/{id}/quality', 'SeedMorphologyAPIController@storeQuality');
    Route::post('seed_morphologies/{id}/media', 'SeedMorphologyAPIController@storeMedia');
    Route::apiResource('seed_morphologies', 'SeedMorphologyAPIController')->except('destroy');
    Route::apiResource('green_houses', 'GreenHouseAPIController');
//    Route::post('password', 'AuthController@login');

    Route::post('import-excel', [ImportExcelAPIController::class,'importFile']);
    Route::get('list-queue', [ImportExcelAPIController::class,'listQueue']);
    Route::get('download-excel', [ImportExcelAPIController::class,'getDownloadExcel']);
});

//Route::post('login', 'AuthController@login');
//Route::post('reset_password', 'AuthController@resetPassword');
