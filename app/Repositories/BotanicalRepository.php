<?php

namespace App\Repositories;

use App\Models\Botanical;
use Illuminate\Container\Container as Application;

/**
 * Class BotanicalRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:54 am UTC
 */
class BotanicalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var BotanicalIrrigationRepository
     */
    private $botanicalIrrigationRepo;
    /**
     * @var LocationRepository
     */
    private $locationRepo;
    /**
     * @var BotanicalPropertyRepository
     */
    private $botanicalPropertyRepo;
    /**
     * @var DistributionHubRepository
     */
    private $distributionHubRepo;

    /**
     * BotanicalRepository constructor.
     * @param Application $app
     * @param BotanicalIrrigationRepository $botanicalIrrigationRepo
     * @param LocationRepository $locationRepo
     * @param BotanicalPropertyRepository $botanicalPropertyRepo
     * @throws \Exception
     */
    public function __construct(Application $app, BotanicalIrrigationRepository $botanicalIrrigationRepo, LocationRepository $locationRepo, BotanicalPropertyRepository $botanicalPropertyRepo, DistributionHubRepository $distributionHubRepo)
    {
        parent::__construct($app);
        $this->botanicalIrrigationRepo = $botanicalIrrigationRepo;
        $this->locationRepo = $locationRepo;
        $this->botanicalPropertyRepo = $botanicalPropertyRepo;
        $this->distributionHubRepo = $distributionHubRepo;
        $this->app = $app;
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
        return Botanical::class;
    }


    public function create($input)
    {
        $botanical = parent::create($this->primaryData());
        $this->storeProperties($input['propagations'], 3, $botanical->id);
        $this->storeProperties($input['planting_conditions'], 4, $botanical->id);

    }

    private function storeProperties($properties, $type_id, $botanical_id)
    {
        $properties = is_array($properties) ? $properties : explode(',', $properties);


        $this->botanicalPropertyRepo
            ->where('botanical_id', $botanical_id)
            ->where('type_id', $type_id)
            ->whereNotIn('property_id', $properties)
            ->delete();
        if (count($properties) && !empty($properties[0])) {
            foreach ($properties as $item) {
                $this->botanicalPropertyRepo->firstOrCreate([
                    'botanical_id' => $botanical_id,
                    'type_id' => $type_id,
                    'property_id' => (int)$item,
                ]);
            }
        }
    }

    public function storeLocation($input, $id)
    {
        if (!empty($input['location_id'])) {
            $this->locationRepo->update($this->locationData($input), $input['location_id']);
        } else {
            $location = $this->locationRepo->create($this->locationData($input));
            $this->createHub($id, 'locations', [$location->id]);
        }

        $this->distributionHubRepo->store($input, $id);

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
            'village' => $input['village'] ?? null,
            'address_en' => $input['address_en'] ?? null,
            'address_fa' => $input['address_fa'] ?? null,
        ];
    }

    public function updateInfo(array $input, $id)
    {
        $this->storeProperties($input['values'], 1, $id);
        $this->storeProperties($input['usages'], 2, $id);
        return $this->update([
            $input['cycle_id'] ?? null,
            $input['protection_id'] ?? null,
            $input['height'] ?? null,
            $input['flower_color'] ?? null,
            $input['fruit_color'] ?? null,
            $input['foliage_color'] ?? null,
        ], $id);
    }

    public function update($input, $id)
    {
        $botanical = parent::update($this->primaryData(), $id);
        $this->storeProperties($input['propagations'], 3, $botanical->id);
        $this->storeProperties($input['planting_conditions'], 4, $botanical->id);

    }

    /**
     * @return array
     */
    private function primaryData(): array
    {
        return [
            'taxonomy_id' => 'taxonomy_id' ?? null,
            'general_origin_id' => 'general_origin_id' ?? null,
            'general_habitat_id' => 'general_habitat_id' ?? null,
            'botanical_irrigation' => 'botanical_irrigation' ?? null,
            'flowering_time' => 'flowering_time' ?? null,
            'organization_id' => 'organization_id' ?? null,
            'internal_habitat_id' => 'internal_habitat_id' ?? null,
            'internal_habitat' => 'internal_habitat' ?? null,
            'entrance_to_garden_id' => 'entrance_to_garden_id' ?? null,
            'seed_germination_id' => 'seed_germination_id' ?? null,
            'cutting_root' => 'cutting_root' ?? null,
            'treatment' => 'treatment' ?? null,
            'first_flowering' => 'first_flowering' ?? null,
            'flowering_period' => 'flowering_period' ?? null,
            'seed_rate_id' => 'seed_rate_id' ?? null,
            'seed_formation_id' => 'seed_formation_id' ?? null,
            'winter_tolerance_id' => 'winter_tolerance_id' ?? null,
            'summer_tolerance_id' => 'summer_tolerance_id' ?? null,
            'soil_id' => 'soil_id' ?? null,
            'growth_rate_id' => 'growth_rate_id' ?? null,
            'sensitivity_conditions' => 'sensitivity_conditions' ?? null,
            'garden_map' => 'garden_map' ?? null,
            'comments' => 'comments' ?? null,
        ];
    }

}
