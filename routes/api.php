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

use App\Repositories\BotanicalOperationRepository;

Route::delete('/{class}/multiple_delete', 'APIController@multipleDestroy');
Route::post('/{class}/hub', 'APIController@storeHub');
Route::delete('/{class}/hub', 'APIController@destroyHub');
Route::get('/{class}/constants', 'APIController@getConstants');
Route::get('relations', 'APIController@relations');


Route::middleware(['auth:api'])->group(function () {
    Route::get('logout', 'AuthController@logout');
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('reset_password', 'AuthController@resetPassword');

Route::apiResource('treatments', 'TreatmentAPIController');

Route::apiResource('paleontologies', 'PaleontologyAPIController');
Route::apiResource('paleontology_citations', 'PaleontologyCitationAPIController');

Route::apiResource('organizations', 'OrganizationAPIController');

Route::apiResource('departments', 'DepartmentAPIController');

Route::apiResource('locations', 'LocationAPIController');

Route::apiResource('connections', 'ConnectionAPIController');

Route::apiResource('continents', 'ContinentAPIController');

Route::apiResource('soils', 'SoilAPIController');

Route::apiResource('villages', 'VillageAPIController');

Route::apiResource('users', 'UserAPIController');

Route::apiResource('technology', 'TechnologyAPIController');

Route::apiResource('seed_weights', 'SeedWeightAPIController');

Route::apiResource('seed_technologies', 'SeedTechnologyAPIController');

Route::apiResource('seed_plants', 'SeedPlantAPIController');


Route::apiResource('seed_features', 'SeedFeatureAPIController');


Route::apiResource('seed_hubs', 'SeedHubAPIController');

Route::apiResource('seed_exchanges', 'SeedExchangeAPIController');

Route::apiResource('bio_moleculars', 'BioMolecularAPIController');

Route::apiResource('seeds', 'SeedAPIController');

Route::apiResource('propagations', 'PropagationAPIController');

Route::apiResource('provinces', 'ProvinceAPIController');

Route::apiResource('protections', 'ProtectionAPIController');

Route::apiResource('projects', 'ProjectAPIController');

Route::apiResource('products', 'ProductAPIController');

Route::apiResource('generals', 'GeneralAPIController');

Route::post('plants/{id}/media', 'PlantAPIController@media');
Route::apiResource('plants', 'PlantAPIController');

Route::post('herbariums/{id}/media', 'HerbariumAPIController@media');
Route::apiResource('herbariums', 'HerbariumAPIController');

Route::apiResource('action_hubs', 'ActionHubAPIController');

Route::apiResource('articles', 'ArticleAPIController');

Route::apiResource('article_hubs', 'ArticleHubAPIController');

Route::apiResource('evaluations', 'EvaluationAPIController');

Route::apiResource('attendances', 'AttendanceAPIController');

Route::get('actors/all', 'ActorAPIController@all');
Route::apiResource('actors', 'ActorAPIController');

Route::apiResource('botanicals', 'BotanicalAPIController');

Route::apiResource('botanical_operations', 'BotanicalOperationAPIController');


Route::apiResource('botanical_irrigations', 'BotanicalIrrigationAPIController');

Route::apiResource('botanical_propagations', 'BotanicalPropagationAPIController');

Route::apiResource('chromosomes', 'ChromosomeAPIController');

Route::apiResource('cities', 'CityAPIController');

Route::apiResource('collections', 'CollectionAPIController');

Route::apiResource('constituents', 'ConstituentAPIController');
Route::apiResource('constituent_types', 'ConstituentTypeAPIController');

Route::apiResource('countries', 'CountryAPIController');


Route::apiResource('cryo_banks', 'CryoBankAPIController');

Route::apiResource('entries', 'EntryAPIController');

Route::apiResource('entry_hubs', 'EntryHubAPIController');

Route::apiResource('gardens', 'GardenAPIController');

Route::apiResource('geology_ages', 'GeologyAgeAPIController');


Route::apiResource('irrigations', 'IrrigationAPIController');


Route::apiResource('lightings', 'LightingAPIController');

Route::apiResource('localities', 'LocalityAPIController');

Route::apiResource('maps', 'MapAPIController');

Route::apiResource('media', 'MediaAPIController');


Route::post('medicinal_plants/{medicinal_plant_id}/provinces', 'MedicinalPlantProvinceAPIController@store');
Route::match(['PUT', 'PATCH'], 'medicinal_plants/{medicinal_plant_id}/provinces', 'MedicinalPlantProvinceAPIController@update');
Route::post('medicinal_plants/{medicinal_plant_id}/constituents', 'MedicinalPlantConstituentAPIController@store');
Route::match(['PUT', 'PATCH'], 'medicinal_plants/{medicinal_plant_id}/constituents', 'MedicinalPlantConstituentAPIController@update');
Route::apiResource('medicinal_plants', 'MedicinalPlantAPIController');



Route::apiResource('medicines', 'MedicineAPIController');

Route::apiResource('methods', 'MethodAPIController');

Route::apiResource('roles', 'RoleAPIController');

Route::apiResource('permissions', 'PermissionAPIController');


Route::apiResource('groups', 'GroupAPIController');

Route::apiResource('divisions', 'DivisionAPIController');

Route::apiResource('germinations', 'GerminationAPIController');

Route::apiResource('repeats', 'RepeatAPIController');

Route::apiResource('stations', 'StationAPIController');

Route::apiResource('blocks', 'BlockAPIController');

Route::apiResource('characters', 'CharacterAPIController');

Route::apiResource('character_traits', 'CharacterTraitAPIController');

Route::apiResource('trait_values', 'TraitValueAPIController');

Route::apiResource('block_traits', 'BlockTraitAPIController');

Route::apiResource('dimensions', 'DimensionAPIController');

Route::apiResource('evaluation_dimensions', 'EvaluationDimensionAPIController');
//Route::apiResource('actor_hubs', 'actorHubAPIController');
Route::apiResource('location_hubs', 'LocationHubAPIController')->except('update', 'show');
//Route::apiResource('user_hubs', 'UserHubAPIController');


Route::apiResource('life_forms', 'LifeFormAPIController');

Route::apiResource('plant_life_forms', 'PlantLifeFormAPIController');

Route::apiResource('medicinal_parts', 'MedicinalPartAPIController');

Route::apiResource('medicinal_plant_types', 'MedicinalPlantTypeAPIController');

Route::apiResource('transactions', 'TransactionAPIController');

Route::apiResource('transaction_evidences', 'TransactionEvidenceAPIController');

Route::apiResource('paleontology_documents', 'PaleontologyDocumentAPIController');

Route::apiResource('action_hub_documents', 'ActionHubDocumentAPIController');

Route::get('taxonomies/all', 'TaxonomyAPIController@all');
Route::apiResource('taxonomies', 'TaxonomyAPIController');


Route::apiResource('planting_conditions', 'PlantingConditionAPIController');
//plant_herbarium action
Route::post('herbariums/{id}/determine', 'PlantHerbariumAPIController@storeDetermine');
Route::post('herbariums/{id}/collect', 'PlantHerbariumAPIController@storeCollect');
Route::post('herbariums/{id}/research', 'PlantHerbariumAPIController@storeResearch');
//CryoBank action
Route::post('cryo_banks/{id}/determine', 'CryoBankAPIController@storeDetermine');
Route::post('cryo_banks/{id}/collect', 'CryoBankAPIController@storeCollect');
Route::post('cryo_banks/{id}/research', 'CryoBankAPIController@storeResearch');
//Paleontology action
Route::post('paleontologies/{id}/determine', 'PaleontologyAPIController@storeDetermine');
Route::post('paleontologies/{id}/collect', 'PaleontologyAPIController@storeCollect');
Route::post('paleontologies/{id}/research', 'PaleontologyAPIController@storeResearch');
//MedicinalPlant action
Route::post('medicinal_plants/{id}/determine', 'MedicinalPlantAPIController@storeDetermine');
Route::post('medicinal_plants/{id}/collect', 'MedicinalPlantAPIController@storeCollect');
Route::post('medicinal_plants/{id}/research', 'MedicinalPlantAPIController@storeResearch');


Route::apiResource('permissions', 'PermissionAPIController');
Route::apiResource('geographicals', 'GeographicalAPIController');
Route::apiResource('plant_geographicals', 'PlantGeographicalAPIController')->except('update', 'edit');

Route::apiResource('roles', 'RoleAPIController');

Route::apiResource('seed_collections', 'SeedCollectionAPIController');


Route::apiResource('biochemical_evaluations', 'BiochemicalEvaluationAPIController');

Route::apiResource('biochemical_evaluation_vars', 'BiochemicalEvaluationVarAPIController');

Route::resource('seed_generals', 'SeedGeneralAPIController');

Route::resource('molecular_evaluations', 'MolecularEvaluationAPIController');

Route::resource('molecular_evaluation_vars', 'MolecularEvaluationVarAPIController');

Route::resource('seeds', 'SeedAPIController');

Route::group(['prefix' => 'morphology'], function () {
    Route::resource('qualitative_evaluations', 'MorphologyQualitativeEvaluationAPIController');

    Route::resource('quantitative_evaluations', 'MorphologyQuantitativeEvaluationAPIController');

    Route::resource('quantitative_evaluation_vars', 'MorphologyQuantitativeEvaluationVarAPIController');
});

