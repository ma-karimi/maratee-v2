<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Herbarium;
use App\Models\LocationHub;
use App\Models\Plant;
use Illuminate\Container\Container as Application;
use Illuminate\Validation\ValidationException;

/**
 * Class HerbariumRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:21 am UTC
 */
class HerbariumRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
//
    ];
    /**
     * @var ActionHubRepository
     */
    private $actionHubRepo;
    /**
     * @var ActorHubRepository
     */
    private $actorHubRepo;
    /**
     * @var LocationRepository
     */
    private $locationRepo;
    /**
     * @var PlantRepository
     */
    private $plantRepo;

    public function __construct(Application $app, ActionHub $actionHubRepo, ActorHub $actorHubRepo, LocationRepository $locationRepo, PlantRepository $plantRepo)
    {
        parent::__construct($app);
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
        $this->locationRepo = $locationRepo;
        $this->plantRepo = $plantRepo;
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
        return Herbarium::class;
    }

    public function create($input)
    {

        $is_flowering = $input['is_flowering'] != 1 ? $input['is_flowering'] : 1;
        $plant = $this->firstOrCreatePlant($input, $is_flowering);
        $location = $this->storeLocation($input, $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        if ($is_flowering == 1) {
            $this->plantRepo->createHub($plant->id, 'locations', [$location->id]);
        }
        $herbarium = parent::create($this->herbariumData($input));
        $this->storeDetermine($input, $herbarium->id);
        $this->storeCollect($input, $herbarium->id);
        $this->storeMedia($input, $herbarium);

        return $herbarium;
    }


    private function firstOrCreatePlant($input, int $is_flowering)
    {

            $plant = Plant::firstOrCreate(['taxonomy_id' => $input['taxonomy_id'], 'is_flowering' => 1]);

        return $plant;
    }


    private function nonFlowerData($input)
    {
        return [
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'general_substrate_id' => $input['general_substrate_id'] ?? null,
        ];
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


    private function locationData($input): array
    {
        return [
            'province_id' => $input['province_id'],
            'city_id' => $input['city_id'] ?? null,
            'address_en' => $input['address_en'] ?? null,
            'address_fa' => $input['address_fa'] ?? null,
            'village' => $input['village'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
        ];
    }


    private function herbariumData($input): array
    {
        return [
            'herbarium_index' => $input->herbarium_index ?? null,
            'herbarium_number' => $input->herbarium_number ?? null,
            'cf' => $input->cf ?? null,
            'is_flowering' => $input->is_flowering ?? null,
            'location_id' => $input->location_id ?? null,
            'taxonomy_id' => $input->taxonomy_id ?? null,
            'organization_id' => $input->organization_id ?? null,
            'tip_picture_id' => $input->tip_picture_id ?? null,
            'consideration' => $input->consideration ?? null,
            'description' => $input->description ?? null,
            'general_phytogeography_id' => $input['general_phytogeography_id'] ?? null,
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'general_substrate_id' => $input['general_substrate_id'] ?? null,
        ];
    }

    private function storeDetermine($input, $herbarium_id)
    {
        $determines = is_array($input['determines']) ? $input['determines'] : explode(',', $input['determines']);

        $action_hub = $this->actionHubRepo->firstOrCreate([
            'action_id' => 1,
            'actionable_type' => Herbarium::class,
            'actionable_id' => $herbarium_id
        ]);

        $this->actorHubRepo
            ->where('actorable_id', $action_hub->id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $determines)
            ->delete();
        if (count($determines) && !empty($determines[0])) {
            foreach ($determines as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub->id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => (int)$item,
                ]);
            }
        }
    }

    private function storeCollect($input, $herbarium_id)
    {
        $collectors = is_array($input['collectors']) ? $input['collectors'] : explode(',', $input['collectors']);

        $action_hub = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => Herbarium::class,
                'actionable_id' => $herbarium_id
            ],
            [
                'date' => $input['date'] ?? null
            ]);
        $this->actorHubRepo
            ->where('actorable_id', $action_hub->id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $collectors)
            ->delete();
        if (count($collectors) && !empty($collectors[0])) {
            foreach ($collectors as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub->id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => (int)$item,
                ]);
            }
        }
    }


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
        $is_flowering = $input['is_flowering'] != 1 ? $input['is_flowering'] : 1;

        $this->storeLocation($input, $input->filled('location_id') ? $input['location_id'] : null);

        $this->changeFloraLocationHubWhenChangeTaxonomyId($input, $id, $is_flowering);

        $model = parent::update($this->herbariumData($input), $id);
        $this->storeDetermine($input, $model->id);
        $this->storeCollect($input, $model->id);

        return $model;
    }


    /**
     * @param $input
     * @param $id
     * @param $is_flowering
     */
    private function changeFloraLocationHubWhenChangeTaxonomyId($input, $id, int $is_flowering): void
    {
        $herbarium = $this->find($id)->load('plant');
        if ($herbarium->taxonomy_id != $input['taxonomy_id']) {
            $plant = $this->firstOrCreatePlant($input, $is_flowering);
            if ($herbarium->plant && $herbarium->is_flowering == 1) {
                LocationHub::where(['locationable_type' => Plant::class, 'locationable_id' => $herbarium->plant->id, 'location_id' => $input['location_id']])->delete();
                LocationHub::create(['locationable_type' => Plant::class, 'locationable_id' => $plant->id, 'location_id' => $input['location_id']]);
            }
        }
    }
}
