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

Route::resource('continents', 'ContinentAPIController');
Route::resource('treatments', 'TreatmentAPIController');
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

Route::resource('planting_factors', 'PlantFactorAPIController');

Route::resource('planting_applications', 'PlantingApplicationAPIController');

Route::resource('plants', 'PlantAPIController');

Route::resource('organizations', 'OrganizationAPIController');




Route::resource('actions', 'ActionAPIController');

Route::resource('action_hubs', 'ActionHubAPIController');

Route::resource('addresses', 'AddressAPIController');

Route::resource('articles', 'ArticleAPIController');

Route::resource('article_hubs', 'ArticleHubAPIController');

Route::resource('assessments', 'AssessmentAPIController');

Route::resource('assessment_collections', 'AssessmentCollectionAPIController');

Route::resource('attendances', 'AttendanceAPIController');

Route::resource('authors', 'AuthorAPIController');

Route::resource('borrows', 'BorrowAPIController');

Route::resource('botanicals', 'BotanicalAPIController');

Route::resource('botanical_garden_actions', 'BotanicalGardenActionAPIController');

Route::resource('botanical_irrigations', 'BotanicalIrrigationAPIController');

Route::resource('botanical_reproductions', 'BotanicalReproductionAPIController');


Route::resource('chromosomes', 'ChromosomeAPIController');

Route::resource('cities', 'CityAPIController');

Route::resource('collections', 'CollectionAPIController');

Route::resource('constituents', 'ConstituentAPIController');

Route::resource('countries', 'CountryAPIController');

Route::resource('credentials', 'CredentialAPIController');

Route::resource('cryo_banks', 'CryoBankAPIController');

Route::resource('cryo_bank_actions', 'CryoBankActionAPIController');

Route::resource('entries', 'EntryAPIController');

Route::resource('entry_hubs', 'EntryHubAPIController');

Route::resource('exchanges', 'ExchangeAPIController');

Route::resource('gardens', 'GardenAPIController');

Route::resource('geology_ages', 'GeologyAgeAPIController');

Route::resource('geramins', 'GeraminAPIController');

Route::resource('herbaria', 'HerbariumAPIController');

Route::resource('herbarium_appendixes', 'HerbariumAppendixAPIController');

Route::resource('irrigations', 'IrrigationAPIController');



Route::resource('lightings', 'LightingAPIController');

Route::resource('localities', 'LocalityAPIController');

Route::resource('maps', 'MapAPIController');

Route::resource('media', 'MediaAPIController');

Route::resource('medicals', 'MedicalAPIController');

Route::resource('medicinal_plants', 'MedicinalPlantAPIController');

Route::resource('medicinal_plant_constituents', 'MedicinalPlantConstituentAPIController');

Route::resource('medicinal_plant_morphologies', 'MedicinalPlantMorphologyAPIController');

Route::resource('medicines', 'MedicineAPIController');

Route::resource('methods', 'MethodAPIController');

Route::resource('moleculars', 'MolecularAPIController');

Route::resource('morphologies', 'MorphologyAPIController');

Route::resource('paleontologies', 'PaleontologyAPIController');

Route::resource('paleontology_actions', 'PaleontologyActionAPIController');

Route::resource('paleontology_citations', 'PaleontologyCitationAPIController');
Route::resource('morphologies', 'MorphologyAPIController');



Route::resource('chemicals', 'ChemicalAPIController');

Route::resource('transitions', 'TransitionAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('permissions', 'PermissionAPIController');

Route::resource('tables', 'TableAPIController');

Route::resource('groups', 'GroupAPIController');

Route::resource('divisions', 'DivisionAPIController');