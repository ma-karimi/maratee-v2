<?php

namespace App\Repositories;

use App\Models\MedicinalPlant;
use App\Models\MedicinalPlantConstituent;
use App\Repositories\BaseRepository;
use Illuminate\Support\Arr;

/**
 * Class MedicinalPlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalPlantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MedicinalPlant::class;
    }

    public function create($input)
    {
        $model=parent::create(Arr::except($input,'life_forms'));
        $location = $this->firstOrCreateLocation($input);
        return $this->storeLifeForm($input, $model);
    }

    public function update($input, $id)
    {
        $model=parent::update(Arr::except($input,'life_forms'),$id);
        return $this->storeLifeForm($input, $model);
    }


    private function storeLifeForm($input, \Illuminate\Database\Eloquent\Model $model)
    {
        $model->cycle_id = $input['life_forms']['cycle_id'] ?? null;
        $model->wooden_id = $input['life_forms']['wooden_id'] ?? null;
        $model->herbaceous_id = $input['life_forms']['herbaceous_id'] ?? null;
        $model->save();
        return $model;
    }

    /**
     * @param $input
     * @return object
     */
    private function firstOrCreateLocation($input)
    {
        $location_input = [
            'city_id' => $input['city_id'],
            'region_name' => $input['region_name'] ?? null,
            'address' => $input['address'] ?? null,
            'village_id' => $input['village_id'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
            'description' => $input['location_description'] ?? null,
        ];
        //store location
        return $this->location_model->firstOrCreate($location_input);
    }

}
