<?php

namespace App\Repositories;

use App\Models\Botanical;
use App\Models\BotanicalIrrigation;
use App\Models\BotanicalProperty;
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
     * @var BotanicalPropertyRepository
     */
    private $botanicalPropertyRepo;

    /**
     * BotanicalRepository constructor.
     * @param Application $app
     * @param BotanicalIrrigation $botanicalIrrigation
     * @param LocationRepository $locationRepo
     * @param BotanicalProperty $botanicalPropertyRepo
     * @throws Exception
     */
    public function __construct(Application $app, BotanicalIrrigation $botanicalIrrigation, LocationRepository $locationRepo, BotanicalProperty $botanicalPropertyRepo)
    {
        parent::__construct($app);
        $this->botanicalIrrigation = $botanicalIrrigation;
        $this->locationRepo = $locationRepo;
        $this->botanicalPropertyRepo = $botanicalPropertyRepo;
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
        $this->createHub($botanical->id, 'fruitColors', is_array($input['fruit_colors']) ? $input['fruit_colors'] : explode(',', $input['fruit_colors']));
        $this->createHub($botanical->id, 'flowerColors', is_array($input['flower_colors']) ? $input['flower_colors'] : explode(',', $input['flower_colors']));
        $this->createHub($botanical->id, 'foliageColors', is_array($input['foliage_colors']) ? $input['foliage_colors'] : explode(',', $input['foliage_colors']));
//        $this->storeProperties($input['cycles'], 5, $botanical->id);
//        $this->storeProperties($input['values'], 1, $botanical->id);
//        $this->storeProperties($input['usages'], 2, $botanical->id);
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
            'height' => $input['height'] ?? null,
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

        $this->storeProperties($input['propagations'], 3, $id);
        $this->storeProperties($input['planting_conditions'], 4, $id);

        return parent::update([
            'entrance_to_garden_id' => $input['entrance_to_garden_id'] ?? null,
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

    public function update($input, $id)
    {
        $botanical = parent::update($this->primaryData($input), $id);
        $this->storeDistributions($input, $botanical);
//        $this->storeProperties($input['cycles'], 5, $id);
//        $this->storeProperties($input['values'], 1, $id);
//        $this->storeProperties($input['usages'], 2, $id);
        $this->createHub($botanical->id, 'values', is_array($input['values']) ? $input['values'] : explode(',', $input['values']));
        $this->createHub($botanical->id, 'usages', is_array($input['usages']) ? $input['usages'] : explode(',', $input['usages']));
        $this->createHub($botanical->id, 'cycles', is_array($input['cycles']) ? $input['cycles'] : explode(',', $input['cycles']));
        $this->createHub($botanical->id, 'fruitColors', is_array($input['fruit_colors']) ? $input['fruit_colors'] : explode(',', $input['fruit_colors']));
        $this->createHub($botanical->id, 'flowerColors', is_array($input['flower_colors']) ? $input['flower_colors'] : explode(',', $input['flower_colors']));
        $this->createHub($botanical->id, 'foliageColors', is_array($input['foliage_colors']) ? $input['foliage_colors'] : explode(',', $input['foliage_colors']));
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
