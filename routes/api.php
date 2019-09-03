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
Route::get('relations', 'APIController@relations');


Route::middleware(['auth:api'])->group(function () {
    Route::get('logout', 'AuthController@logout');
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('reset_password', 'AuthController@resetPassword');

Route::resource('treatments', 'TreatmentAPIController');

Route::resource('paleontologies', 'PaleontologyAPIController');

Route::apiResource('organizations', 'OrganizationAPIController');

Route::apiResource('departments', 'DepartmentAPIController');

Route::apiResource('locations', 'LocationAPIController');

Route::apiResource('connections', 'ConnectionAPIController');

Route::resource('continents', 'ContinentAPIController');

Route::resource('soil_features', 'SoilFeatureAPIController');

Route::resource('soils', 'SoilAPIController');

Route::resource('villages', 'VillageAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('technology', 'TechnologyAPIController');

Route::resource('soil_has_soil_features', 'SoilHasSoilFeatureAPIController');

Route::resource('seed_weights', 'SeedWeightAPIController');

Route::resource('seed_technologies', 'SeedTechnologyAPIController');

Route::resource('seed_plants', 'SeedPlantAPIController');


Route::resource('seed_features', 'SeedFeatureAPIController');


Route::resource('seed_hubs', 'SeedHubAPIController');

Route::resource('seed_exchanges', 'SeedExchangeAPIController');

Route::resource('bio_moleculars', 'BioMolecularAPIController');

Route::resource('seeds', 'SeedAPIController');

Route::resource('propagations', 'PropagationAPIController');

Route::resource('provinces', 'ProvinceAPIController');

Route::resource('protections', 'ProtectionAPIController');

Route::resource('projects', 'ProjectAPIController');

Route::resource('products', 'ProductAPIController');

Route::resource('planting_actions', 'PlantingActionAPIController');

Route::resource('generals', 'GeneralAPIController');

Route::resource('plants', 'PlantAPIController');

Route::resource('actions', 'ActionAPIController');

Route::resource('action_hubs', 'ActionHubAPIController');

Route::resource('articles', 'ArticleAPIController');

Route::resource('article_hubs', 'ArticleHubAPIController');

Route::resource('evaluations', 'EvaluationAPIController');

Route::resource('attendances', 'AttendanceAPIController');

Route::resource('authors', 'AuthorAPIController');

Route::resource('botanicals', 'BotanicalAPIController');

Route::resource('botanical_garden_actions', 'BotanicalGardenActionAPIController');


Route::resource('botanical_irrigations', 'BotanicalIrrigationAPIController');

Route::resource('botanical_propagations', 'BotanicalPropagationAPIController');

Route::resource('chromosomes', 'ChromosomeAPIController');

Route::resource('cities', 'CityAPIController');

Route::resource('collections', 'CollectionAPIController');

Route::resource('constituents', 'ConstituentAPIController');

Route::resource('countries', 'CountryAPIController');


Route::resource('cryo_banks', 'CryoBankAPIController');

Route::resource('entries', 'EntryAPIController');

Route::resource('entry_hubs', 'EntryHubAPIController');

Route::resource('gardens', 'GardenAPIController');

Route::resource('geology_ages', 'GeologyAgeAPIController');

Route::resource('herbariums', 'HerbariumAPIController');

Route::resource('irrigations', 'IrrigationAPIController');


Route::resource('lightings', 'LightingAPIController');

Route::resource('localities', 'LocalityAPIController');

Route::resource('maps', 'MapAPIController');

Route::resource('media', 'MediaAPIController');


Route::resource('medicinal_plants', 'MedicinalPlantAPIController');

Route::resource('medicinal_plant_constituents', 'MedicinalPlantConstituentAPIController');


Route::resource('medicines', 'MedicineAPIController');

Route::resource('methods', 'MethodAPIController');


Route::resource('paleontologies', 'PaleontologyAPIController');


Route::resource('roles', 'RoleAPIController');

Route::resource('permissions', 'PermissionAPIController');


Route::resource('groups', 'GroupAPIController');

Route::resource('divisions', 'DivisionAPIController');

Route::resource('germinations', 'GerminationAPIController');

Route::resource('repeats', 'RepeatAPIController');

Route::resource('stations', 'StationAPIController');

Route::resource('blocks', 'BlockAPIController');

Route::resource('characters', 'CharacterAPIController');

Route::resource('character_traits', 'CharacterTraitAPIController');

Route::resource('trait_values', 'TraitValueAPIController');

Route::resource('block_traits', 'BlockTraitAPIController');

Route::resource('dimensions', 'DimensionAPIController');

Route::resource('evaluation_dimensions', 'EvaluationDimensionAPIController');
//Route::resource('author_hubs', 'AuthorHubAPIController');
//Route::resource('location_hubs', 'LocationHubAPIController');
//Route::resource('user_hubs', 'UserHubAPIController');


Route::resource('life_forms', 'LifeFormAPIController');

Route::resource('plant_life_forms', 'PlantLifeFormAPIController');

Route::resource('medicinal_parts', 'MedicinalPartAPIController');

Route::resource('medicinal_plant_types', 'MedicinalPlantTypeAPIController');

Route::resource('transactions', 'TransactionAPIController');

Route::resource('transaction_evidences', 'TransactionEvidenceAPIController');


Route::resource('paleontology_documents', 'PaleontologyDocumentAPIController');

Route::resource('paleontology_maps', 'PaleontologyMapAPIController');

Route::resource('action_hub_documents', 'ActionHubDocumentAPIController');