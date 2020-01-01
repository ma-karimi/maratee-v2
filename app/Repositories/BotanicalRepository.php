<?php

namespace App\Repositories;

use App\Models\Botanical;
use App\Models\BotanicalIrrigation;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

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
     * @var BotanicalIrrigation
     */
    private $botanicalIrrigation;
    /**
     * @var LocationRepository
     */
    private $locationRepo;

    /**
     * BotanicalRepository constructor.
     * @param Application $app
     * @param BotanicalIrrigation $botanicalIrrigation
     * @param LocationRepository $locationRepo
     * @throws Exception
     */
    public function __construct(Application $app, BotanicalIrrigation $botanicalIrrigation, LocationRepository $locationRepo)
    {
        parent::__construct($app);
        $this->botanicalIrrigation = $botanicalIrrigation;
        $this->locationRepo = $locationRepo;
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
        $botanical = parent::create($this->primaryData($input));

        $this->storeDistributions($input, $botanical);
        $this->createHub($botanical->id, 'values', is_array($input['values']) ? $input['values'] : explode(',', $input['values']));
        $this->createHub($botanical->id, 'usages', is_array($input['usages']) ? $input['usages'] : explode(',', $input['usages']));
        $this->createHub($botanical->id, 'cycles', is_array($input['cycles']) ? $input['cycles'] : explode(',', $input['cycles']));
        $this->createHub($botanical->id, 'fruitColors', is_array($input['fruit_colors']) ? $input['fruit_colors'] : explode(',', $input['fruit_colors']), ['type_id' => 2]);
        $this->createHub($botanical->id, 'flowerColors', is_array($input['flower_colors']) ? $input['flower_colors'] : explode(',', $input['flower_colors']), ['type_id' => 1]);
        $this->createHub($botanical->id, 'foliageColors', is_array($input['foliage_colors']) ? $input['foliage_colors'] : explode(',', $input['foliage_colors']), ['type_id' => 3]);
        return $botanical;
    }

    /**
     * @param $input
     * @return array
     */
    private function primaryData($input): array
    {
        return [
            'taxonomy_id' => $input['taxonomy_id'] ?? null,
            'origin_id' => $input['origin_id'] ?? null,
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'organization_id' => $input['organization_id'] ?? null,
            'internal_habitat_id' => $input['internal_habitat_id'] ?? null,
            'protection_id' => $input['protection_id'] ?? null,
            'wooden_id' => $input['wooden_id'] ?? null,
            'height' => $input['height'] ?? null,
            'entrance_to_garden_id' => $input['entrance_to_garden_id'] ?? null,
        ];
    }

    private function storeDistributions($input, $botanical)
    {
        $distributions = request()->filled('distributions') ? explode(',', $input['distributions']) : [];
        $this->createHub($botanical->id, 'distributions', $distributions);
    }

    public function storeLocation($input, $id)
    {
        if (!empty($input['location_id'])) {
            $this->locationRepo->update($this->locationData($input), $input['location_id']);
        } else {
            $location = $this->locationRepo->create($this->locationData($input));
            $botanical = $this->find($id);
            $this->createHub($botanical->id, 'locations', [$location->id]);
        }


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
        $botanical = parent::update([
            'seed_germination_id' => $input['seed_germination_id'] ?? null,
            'cutting_rooting' => $input['cutting_rooting'] ?? null,
            'treatment' => $input['treatment'] ?? null,
            'first_flowering' => $input['first_flowering'] ?? null,
            'flowering_period' => $input['flowering_period'] ?? null,
            'seed_rate_id' => $input['seed_rate_id'] ?? null,
            'seed_formation_id' => $input['seed_formation_id'] ?? null,
            'winter_tolerance_id' => $input['winter_tolerance_id'] ?? null,
            'summer_tolerance_id' => $input['summer_tolerance_id'] ?? null,
            'soil_id' => $input['soil_id'] ?? null,
            'growth_rate_id' => $input['growth_rate_id'] ?? null,
            'sensitivity_conditions' => $input['sensitivity_conditions'] ?? null,
            'garden_map' => $input['garden_map'] ?? null,
            'comments' => $input['comments'] ?? null,
        ], $id);
        $this->createHub($botanical->id, 'propagations', is_array($input['propagations']) ? $input['propagations'] : explode(',', $input['propagations']));
        $this->createHub($botanical->id, 'plantingConditions', is_array($input['planting_conditions']) ? $input['planting_conditions'] : explode(',', $input['planting_conditions']));

        return $botanical;
    }

    public function update($input, $id)
    {
        $botanical = parent::update($this->primaryData($input), $id);
        $this->storeDistributions($input, $botanical);
        $this->createHub($botanical->id, 'values', is_array($input['values']) ? $input['values'] : explode(',', $input['values']));
        $this->createHub($botanical->id, 'usages', is_array($input['usages']) ? $input['usages'] : explode(',', $input['usages']));
        $this->createHub($botanical->id, 'cycles', is_array($input['cycles']) ? $input['cycles'] : explode(',', $input['cycles']));
        $this->createHub($botanical->id, 'fruitColors', is_array($input['fruit_colors']) ? $input['fruit_colors'] : explode(',', $input['fruit_colors']), ['type_id' => 2]);
        $this->createHub($botanical->id, 'flowerColors', is_array($input['flower_colors']) ? $input['flower_colors'] : explode(',', $input['flower_colors']), ['type_id' => 1]);
        $this->createHub($botanical->id, 'foliageColors', is_array($input['foliage_colors']) ? $input['foliage_colors'] : explode(',', $input['foliage_colors']), ['type_id' => 3]);
        return $botanical;
    }

    public function storeBotanicalIrrigation(array $input)
    {
        return $this->botanicalIrrigation->updateOrCreate(['botanical_id' => $input['botanical_id']], Arr::except($input, 'botanical_id'));
    }

    public function storeMedia($id)
    {
        $model = $this->find($id);
        $media_input = [
            'media_type' => $input['media_type'] ?? 2,
        ];
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection('images');
            $media_record->update($media_input);
        }
    }

}
