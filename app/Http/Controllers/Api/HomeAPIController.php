<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Models\Actor;
use App\Models\General;
use App\Models\NonflowerGeneral;
use App\Models\PaleobotanyGeneral;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class HomeAPIController
 * @package App\Http\Controllers\Api
 */
class HomeAPIController extends AppBaseController
{

    public $classes = [
        'botanicals' => 'BotanicalRepository',
        'plants' => 'PlantRepository',
//        'nonflowers' => 'NonflowerRepository',
        'medicinal_properties' => 'MedicinalPlantRepository',
        'medicinal_applications' => 'MedicinalApplicationRepository',
        'natural_compounds' => 'MedicinalLocationRepository',
        'herbariums' => 'HerbariumRepository',
        'pharmaceuticals' => 'ProductRepository',
        'seed_collections' => 'SeedCollectionRepository',
        'cryo_banks' => 'CryoBankRepository',
//        'chromosomes' => 'ChromosomeRepository'

    ];

    public $types = ['family', 'genus', 'species', 'sub_species', 'variety'];
    public $generals = [
        'generals' => 'General',
//        'nonflowerGenerals' => 'NonflowerGeneral',
//        'paleobotanyGenerals' => 'PaleobotanyGeneral',
    ];

    public function index(Request $request)
    {
        ini_set('max_execution_time', 3000);
        ini_set('memory_limit', '3000M');
        $data = [];
        $data['loaded'] = false;
        if (collect($request->all())->filter()->count() > 0) {

            foreach ($this->classes as $index => $repository) {
                $class = resolve('App\Repositories\\' . $repository);
                $data[$index] = $class
                    ->all([], null, null, $class->getRelationFields());

                $data['loaded'] = true;
            }

        }

        return $this->sendResponse($data, 'Data retrieved successfully');
    }

    public function data()
    {

        $data = [];

        foreach ($this->generals as $index => $model) {
            $data[$index] = resolve('App\Models\\' . $model)->whereIn('type', $this->types)
                ->get()
                ->sortBy('name_author')
                ->mapToGroups(function ($item, $key) {
                    return [$item['type'] => ['id' => $item['id'], 'name' => $item['name_author']]];
                })
                ->all();

        }
//        $data['generals']['actors'] = Actor::all();

        return $this->sendResponse($data, 'Data retrieved successfully');
    }
}
