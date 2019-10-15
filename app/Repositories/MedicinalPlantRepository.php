<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\MedicinalPlant;
use Illuminate\Container\Container as Application;
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
     * @var Location
     */
    private $location_model;

    /**
     * MedicinalPlantRepository constructor.
     * @param Application $app
     * @param Location $location_model
     * @throws \Exception
     */
    public function __construct(Application $app, Location $location_model)
    {
        parent::__construct($app);
        $this->location_model = $location_model;
    }

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
        $input['location_id'] = $this->createLocation($input)->id;
        $model = parent::create(Arr::except($input, $this->locationAndLifeFormsData()));
        return $this->storeLifeForm($input, $model);
    }

    /**
     * @param $input
     * @return object
     */
    private function createLocation($input)
    {
        $location_input = $this->locationData($input);

        return $this->location_model->create($location_input);
    }

    /**
     * @param $input
     * @return array
     */
    private function locationData($input): array
    {
        return [
            'province_id' => $input['province_id'],
            'city_id' => $input['city_id'] ?? null,
            'region_name' => $input['region_name'] ?? null,
            'address' => $input['address'] ?? null,
            'village_id' => $input['village_id'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
            'description' => $input['location_description'] ?? null,
        ];
    }

    /**
     * @return array
     */
    private function locationAndLifeFormsData(): array
    {
        return ['life_forms', 'address', 'province_id', 'village_id', 'province_id', 'region_name', 'min_altitude', 'max_altitude', 'point', 'location_description'];
    }

    private function storeLifeForm($input, \Illuminate\Database\Eloquent\Model $model)
    {
        $model->cycle_id = $input['life_forms']['cycle_id'] ?? null;
        $model->wooden_id = $input['life_forms']['wooden_id'] ?? null;
        $model->herbaceous_id = $input['life_forms']['herbaceous_id'] ?? null;
        $model->save();
        return $model;
    }

    public function update($input, $id)
    {
        $this->updateLocation($input);
        $model = parent::update(Arr::except($input, $this->locationAndLifeFormsData()), $id);
        return $this->storeLifeForm($input, $model);
    }

    /**
     * @param $input
     * @return object
     */
    private function updateLocation($input)
    {
        $location_input = $this->locationData($input);

        return $this->location_model->find($input['location_id'])->update($location_input);
    }

}
