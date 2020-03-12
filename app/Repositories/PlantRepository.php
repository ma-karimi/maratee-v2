<?php

namespace App\Repositories;

use App\Models\Plant;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

/**
 * Class PlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class PlantRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    private $locationRepo;

    /**
     * PlantRepository constructor.
     * @param Application $app
     * @param LocationRepository $locationRepo
     * @throws Exception
     */
    public function __construct(Application $app, LocationRepository $locationRepo)
    {
        parent::__construct($app);
        $this->locationRepo = $locationRepo;
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
        return Plant::class;
    }


    public function create($input)
    {
        $plant = $this->createPlant($input);

        $this->createHub($plant->id, 'geographicals', $input['geographicals']);
        $this->createHub($plant->id, 'iranGeographicals', $input['iran_geographicals']);
        $this->storeMedia($input, $plant);


        return $plant;
    }

    private function createPlant($input)
    {
        $plant_input = [
            'taxonomy_id' => $input['taxonomy_id'],
            'protection_id' => $input['protection_id'] ?? null,
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'description' => $input['description'] ?? null,
            'habitat_description' => $input['habitat_description'] ?? null,
            'ecology_description' => $input['ecology_description'] ?? null,
            'life_form_id' => $input['life_form_id'] ?? null,
//            'is_flowering' => $input['is_flowering'] ?? 1,
            'flowering_time' => $input['flowering_time'] ?? null,
            'number' => $input['number'] ?? null,
            'monopoly_of_iran_id' => $input['monopoly_of_iran_id'] ?? null,
            'n_no' => $input['n_no'] ?? null,
            'n2_no' => $input['n2_no'] ?? null,
        ];
        //store plant
        return parent::create($plant_input);
    }

    /**
     * @param $input
     * @param $location_id
     * @return Builder|Builder[]|Collection|Model
     * @throws ValidationException
     * @deprecated by dr.jamzad
     */
    private function storeLocation($input, $location_id)
    {
        if ($location_id) {
            $location = $this->locationRepo->update($this->locationData($input), $location_id);
        } else {
            $location = $this->locationRepo->create($this->locationData($input));
        }
        return $location;
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
            'address_en' => $input['address_en'] ?? null,
            'address_fa' => $input['address_fa'] ?? null,
            'village' => $input['village'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
        ];
    }

    /**
     * @param $input
     * @param $model
     */
    public function storeMedia($input, $model): void
    {
        $media_input = [
            'media_type' => $input['media_type'] ?? 2,
        ];
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection('images');
            $media_record->update($media_input);
        }
    }


    public function update($input, $id)
    {
        $plant_input = [
            'taxonomy_id' => $input['taxonomy_id'],
            'protection_id' => $input['protection_id'] ?? null,
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'description' => $input['description'] ?? null,
            'habitat_description' => $input['habitat_description'] ?? null,
            'ecology_description' => $input['ecology_description'] ?? null,
            'flowering_time' => $input['flowering_time'] ?? null,
            'number' => $input['number'] ?? null,
            'monopoly_of_iran_id' => $input['monopoly_of_iran_id'] ?? null,
            'life_form_id' => $input['life_form_id'] ?? null,
            'n_no' => $input['n_no'] ?? null,
            'n2_no' => $input['n2_no'] ?? null,
        ];
        $plant =  parent::update($plant_input, $id);

        $this->createHub($plant->id, 'geographicals', $input['geographicals']);
        $this->createHub($plant->id, 'iranGeographicals', $input['iran_geographicals']);

        return $plant;
    }


}
