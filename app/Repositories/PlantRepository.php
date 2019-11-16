<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Herbarium;
use App\Models\Location;
use App\Models\LocationHub;
use App\Models\Plant;
use App\Models\Taxonomy;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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

    private $taxonomy_model;
    private $locationRepo;
    /**
     * @var HerbariumRepository
     */
    private $herbariumRepo;
    /**
     * @var ActionHubRepository
     */
    private $actionHubRepo;
    /**
     * @var ActorHubRepository
     */
    private $actorHubRepo;

    /**
     * PlantRepository constructor.
     * @param Application $app
     * @param Taxonomy $taxonomy_model
     * @param LocationRepository $locationRepo
     * @param HerbariumRepository $herbariumRepo
     * @param ActionHubRepository $actionHubRepo
     * @param ActorHubRepository $actorHubRepo
     * @throws \Exception
     */
    public function __construct(Application $app, Taxonomy $taxonomy_model, LocationRepository $locationRepo, HerbariumRepository $herbariumRepo, ActionHubRepository $actionHubRepo, ActorHubRepository $actorHubRepo)
    {
        parent::__construct($app);
        $this->taxonomy_model = $taxonomy_model;
        $this->locationRepo = $locationRepo;
        $this->herbariumRepo = $herbariumRepo;
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
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

    /**
     * @param array $input
     * @return Model|void
     */
    public function create($input)
    {
        $plant = $this->createPlant($input);
        $location = $this->createLocation($input);
        if (!isset($plant->is_flowering)) {
            $herbarium = $this->herbariumRepo->create($this->herbariumData($input, $location->id));
            $this->storeDetermine($input, $herbarium->id);
            $this->storeCollect($input, $herbarium->id);
        } else {
            $this->createHub($plant->id, 'locations', [$location->id]);
        }
        $this->storeMedia($input, $plant);


        return $plant;
    }

    /**
     * @param $input
     * @return Model
     */
    private function createPlant($input)
    {
        $plant_input = [
            'taxonomy_id' => $input['taxonomy_id'],
            'protection_id' => $input['protection_id'],
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'general_substrate_id' => $input['general_substrate_id'] ?? null,
            'description' => $input['description'] ?? null,
            'habitat_description' => $input['habitat_description'] ?? null,
            'ecology_description' => $input['ecology_description'] ?? null,
            //life_form
            'life_form_id' => $input['life_form_id'] ?? null,
            //
            'is_flowering' => $input['is_flowering'] ?? 0,
            'flowering_time' => $input['flowering_time'] ?? null,
            'number' => $input['number'] ?? null,
            'monopoly_of_iran_id' => $input['monopoly_of_iran_id'] ?? null,
//            'sheets_no' => $input['sheets_no'] ?? null,
//            'samples_no' => $input['samples_no'] ?? null,
//            'tip_qt' => $input['tip_qt'] ?? null,
//            'physical_tip_qt' => $input['physical_tip_qt'] ?? null,
        ];
        //store plant
        return parent::create($plant_input);
    }

    /**
     * @param $input
     * @return object
     */
    private function createLocation($input)
    {
        return $this->locationRepo->create($this->locationData($input));
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
            'village_id' => $input['village_id'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
            'description' => $input['geographical_description'] ?? null,
        ];
    }

    private function herbariumData(array $data, $location_id)
    {
        $data = Arr::only($data, ['taxonomy_id', 'organization_id', 'herbarium_number', 'cf', 'herbarium_index']);
        $data['location_id'] = $location_id;
        return $data;
    }

    /**
     * @param $input
     * @param $model
     */
    public function storeMedia($input, $model): void
    {
        $media_input = [
            'date' => $input['date'] ?? null,
            'user_id' => $input['user_id'] ?? null,
            'location_id' => $input['location_id'] ?? null,
            'description' => $input['media_description'] ?? null,
            'media_type' => $input['media_type'] ?? 2,
            'reference' => $input['reference'] ?? null,
        ];
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection('media');
            $media_record->update($media_input);
        }
    }

    /**
     * @param array $input
     * @param $id
     * @return Model|void
     */
    public function update($input, $id)
    {
//        [$taxonomy_input, $taxonomy_id] = $this->firstOrCreateTaxonomy($input);
//        $location = $this->updateLocation($input);
        $plant = $this->updatePlant($input, $id);
        if (!isset($plant->is_flowering)) {
            $this->herbariumRepo->update($this->herbariumData($input, $input['location_id']), $input['herbarium_id']);
            $this->storeDetermine($input, $input['herbarium_id']);
            $this->storeCollect($input, $input['herbarium_id']);
        }
//        $this->syncPlantGeneralProperties($taxonomy_input, $plant);
//        $this->syncPlantTypeProperties($input, $plant);
        $this->storeMedia($input, $plant);
        return $plant;
    }

    /**
     * @param $input
     * @param $id
     * @return Builder|Builder[]|Collection|Model
     */
    private function updatePlant($input, $id)
    {
        $plant_input = [
            'taxonomy_id' => $input['taxonomy_id'],
            'protection_id' => $input['protection_id'],
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'general_substrate_id' => $input['general_substrate_id'] ?? null,
            'description' => $input['description'] ?? null,
            'habitat_description' => $input['habitat_description'] ?? null,
            'ecology_description' => $input['ecology_description'] ?? null,

            //
            'is_flowering' => $input['is_flowering'] ?? 0,
            'flowering_time' => $input['flowering_time'] ?? null,
            'number' => $input['number'] ?? null,
            'monopoly_of_iran_id' => $input['monopoly_of_iran_id'] ?? null,
            'life_form_id' => $input['life_form_id'] ?? null,

//            'sheets_no' => $input['sheets_no'] ?? null,
//            'samples_no' => $input['samples_no'] ?? null,
//            'tip_qt' => $input['tip_qt'] ?? null,
//            'physical_tip_qt' => $input['physical_tip_qt'] ?? null
        ];
        return parent::update($plant_input, $id);
    }

    /**
     * @param $input
     * @return array
     */
    private function firstOrCreateTaxonomy($input): array
    {
        $taxonomy_input = [
            'family_id' => $input['family_id'],
            'genus_id' => $input['genus_id'] ?? null,
            'species_id' => $input['species_id'] ?? null,
            'subspecies_id' => $input['subspecies_id'] ?? null,
            'variety_id' => $input['variety_id'] ?? null,
            'name' => $input['name'] ?? null,
        ];
        //store taxonomy
        $result = $this->taxonomy_model->firstOrCreate($taxonomy_input);
        return [$taxonomy_input, $result->id];
    }

    /**
     * @param $input
     * @return object
     */
    private function updateLocation($input)
    {
        $location_input = $this->locationData($input);
        $data = $this->locationRepo->find($input['location_id']);
        $data->fill($location_input);
        $data->save();
        return $data;
    }

    /**
     * @param array $taxonomy_input
     * @param Model $plant
     */
    private function syncPlantGeneralProperties(array $taxonomy_input, $plant): void
    {
        $general_input = array_filter($taxonomy_input, function ($value, $key) {
            return $value !== null and $key !== 'name';/* and $key !== 'plant_id';*/
        }, ARRAY_FILTER_USE_BOTH);
        $plant->generals()->sync($general_input);
    }

    /**
     *
     * @param $input
     * @param Model $plant
     * @return mixed
     * @deprecated
     */
    private function syncPlantTypeProperties($input, $plant)
    {
        if (!empty($input['plant_types'])) {
            $plant->generals()->sync($input['plant_types']);
        }
    }

    private function storeDetermine($input, $herbarium_id)
    {
        $determines = $input['determines'];

        $action_hub_id = $this->actionHubRepo->firstOrCreate([
            'action_id' => 1,
            'actionable_type' => Herbarium::class,
            'actionable_id' => $herbarium_id
        ]);

        $this->actorHubRepo
            ->where('actorable_id', $action_hub_id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $determines)
            ->delete();
        if (count($determines)) {
            foreach ($determines as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub_id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => $item,
                ]);
            }
        }
    }

    private function storeCollect($input, $herbarium_id)
    {
        $collectors = $input['collectors'];

        $action_hub_id = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => Herbarium::class,
                'actionable_id' => $herbarium_id
            ],
            [
                'date' => $input['date'] ?? null
            ]);
        $this->actorHubRepo
            ->where('actorable_id', $action_hub_id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $collectors)
            ->delete();
        if (count($collectors)) {
            foreach ($collectors as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub_id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => $item,
                ]);
            }
        }
    }
}
