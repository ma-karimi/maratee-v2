<?php

namespace App\Repositories;

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
     * PlantRepository constructor.
     * @param Application $app
     * @param Taxonomy $taxonomy_model
     * @param LocationRepository $locationRepo
     * @param HerbariumRepository $herbariumRepo
     * @throws \Exception
     */
    public function __construct(Application $app, Taxonomy $taxonomy_model, LocationRepository $locationRepo, HerbariumRepository $herbariumRepo)
    {
        parent::__construct($app);
        $this->taxonomy_model = $taxonomy_model;
        $this->locationRepo = $locationRepo;
        $this->herbariumRepo = $herbariumRepo;
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
//        [$taxonomy_input, $taxonomy_id] = $this->firstOrCreateTaxonomy($input);
        $plant = $this->createPlant($input);
        $location = $this->createLocation($input);
        if (!isset($plant->is_flowering)) {
            $this->herbariumRepo->create($this->herbariumData($input, $location->id));
        }else{
            $this->createHub($plant->id, 'locations', [$location->id]);
        }
//        $this->syncPlantGpeneralProperties($taxonomy_input, $plant);
//        $this->syncPlantTypeProperties($input, $plant);
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
//            'organization_id' => $input['organization_id'],
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'general_substrate_lichen_id' => $input['general_substrate_lichen_id'] ?? null,
            'general_substrate_moss_id' => $input['general_substrate_moss_id'] ?? null,
            'general_substrate_diatom_id' => $input['general_substrate_diatom_id'] ?? null,
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
        }
//        $this->syncPlantGeneralProperties($taxonomy_input, $plant);
//        $this->syncPlantTypeProperties($input, $plant);
        $this->updateMedia($input, $plant);
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
//            'location_id' => $location_id,
            'protection_id' => $input['protection_id'],
//            'organization_id' => $input['organization_id'],
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'general_substrate_lichen_id' => $input['general_substrate_lichen_id'] ?? null,
            'general_substrate_moss_id' => $input['general_substrate_moss_id'] ?? null,
            'general_substrate_diatom_id' => $input['general_substrate_diatom_id'] ?? null,
            'description' => $input['description'] ?? null,
            'habitat_description' => $input['habitat_description'] ?? null,
            'ecology_description' => $input['ecology_description'] ?? null,

            //
            'is_flowering' => $input['is_flowering'] ?? 0,
            'flowering_time' => $input['flowering_time'] ?? null,
            'number' => $input['number'] ?? null,
            'monopoly_of_iran_id' => $input['monopoly_of_iran_id'] ?? null,
            'life_form_id' => $input['life_form_id'] ?? null,

//            'herbarium_number' => $input['herbarium_number'] ?? null,
//            'herbarium_index' => $input['herbarium_index'] ?? null,
//            'cf' => $input['cf'] ?? null,
//            'sheets_no' => $input['sheets_no'] ?? null,
//            'samples_no' => $input['samples_no'] ?? null,
//            'tip_qt' => $input['tip_qt'] ?? null,
//            'physical_tip_qt' => $input['physical_tip_qt'] ?? null
        ];
        return parent::update($plant_input, $id);
    }

    /**
     * @param $input
     * @param $model
     */
    private function updateMedia($input, $model): void
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
     * @param $input
     * @param Model $plant
     * @return mixed
     */
    private function syncPlantTypeProperties($input, $plant)
    {
        if (!empty($input['plant_types'])) {
            $plant->generals()->sync($input['plant_types']);
        }
    }
}
