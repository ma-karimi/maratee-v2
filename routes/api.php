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

Route::post('{class}/{id}/{relation}', 'APIController@storeMany');


Route::middleware(['auth:api'])->group(function () {
    Route::get('logout', 'AuthController@logout');
});

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('reset_password', 'AuthController@resetPassword');

Route::apiResource('treatments', 'TreatmentAPIController');

Route::apiResource('paleontologies', 'PaleontologyAPIController');

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

Route::apiResource('planting_actions', 'PlantingActionAPIController');

Route::apiResource('generals', 'GeneralAPIController');

Route::apiResource('plant_herbariums', 'PlantHerbariumAPIController');

Route::apiResource('actions', 'ActionAPIController');

Route::apiResource('action_hubs', 'ActionHubAPIController');

Route::apiResource('articles', 'ArticleAPIController');

Route::apiResource('article_hubs', 'ArticleHubAPIController');

Route::apiResource('evaluations', 'EvaluationAPIController');

Route::apiResource('attendances', 'AttendanceAPIController');

Route::apiResource('actors', 'ActorAPIController');

Route::apiResource('botanicals', 'BotanicalAPIController');

Route::apiResource('botanical_operations', 'BotanicalOperationAPIController');


Route::apiResource('botanical_irrigations', 'BotanicalIrrigationAPIController');

Route::apiResource('botanical_propagations', 'BotanicalPropagationAPIController');

Route::apiResource('chromosomes', 'ChromosomeAPIController');

Route::apiResource('cities', 'CityAPIController');

Route::apiResource('collections', 'CollectionAPIController');

Route::apiResource('constituents', 'ConstituentAPIController');

Route::apiResource('countries', 'CountryAPIController');


Route::apiResource('cryo_banks', 'CryoBankAPIController');

Route::apiResource('entries', 'EntryAPIController');

Route::apiResource('entry_hubs', 'EntryHubAPIController');

Route::apiResource('gardens', 'GardenAPIController');

Route::apiResource('geology_ages', 'GeologyAgeAPIController');

Route::apiResource('herbariums', 'HerbariumAPIController');

Route::apiResource('irrigations', 'IrrigationAPIController');


Route::apiResource('lightings', 'LightingAPIController');

Route::apiResource('localities', 'LocalityAPIController');

Route::apiResource('maps', 'MapAPIController');

Route::apiResource('media', 'MediaAPIController');


Route::apiResource('medicinal_plants', 'MedicinalPlantAPIController');

Route::apiResource('medicinal_plant_constituents', 'MedicinalPlantConstituentAPIController');


Route::apiResource('medicines', 'MedicineAPIController');

Route::apiResource('methods', 'MethodAPIController');


Route::apiResource('paleontologies', 'PaleontologyAPIController');


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
//Route::apiResource('location_hubs', 'LocationHubAPIController');
//Route::apiResource('user_hubs', 'UserHubAPIController');


Route::apiResource('life_forms', 'LifeFormAPIController');

Route::apiResource('plant_life_forms', 'PlantLifeFormAPIController');

Route::apiResource('medicinal_parts', 'MedicinalPartAPIController');

Route::apiResource('medicinal_plant_types', 'MedicinalPlantTypeAPIController');

Route::apiResource('transactions', 'TransactionAPIController');

Route::apiResource('transaction_evidences', 'TransactionEvidenceAPIController');

Route::apiResource('paleontology_documents', 'PaleontologyDocumentAPIController');

Route::apiResource('paleontology_maps', 'PaleontologyMapAPIController');

Route::apiResource('action_hub_documents', 'ActionHubDocumentAPIController');

Route::apiResource('taxonomies', 'TaxonomyAPIController');


Route::resource('planting_conditions', 'PlantingConditionAPIController');