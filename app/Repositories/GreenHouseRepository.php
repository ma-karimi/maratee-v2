<?php

namespace App\Repositories;

use App\Models\GreenHouse;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

/**
 * Class GreenHouseRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class GreenHouseRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    private $locationRepo;

    /**
     * GreenHouseRepository constructor.
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
        return GreenHouse::class;
    }


    public function create($input)
    {
        $location = $this->storeLocation($input['location'], $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        return parent::create(Arr::except($input, 'location'));
    }

    public function update($input, $id)
    {
        $location = $this->storeLocation($input['location'], $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        return parent::update(Arr::except($input, 'location'), $id);
    }

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
}
