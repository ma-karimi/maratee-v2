<?php

namespace App\Repositories;

use App\Models\PlantHerbarium;
use App\Models\Taxonomy;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class PlantHerbariumRepository extends BaseRepository
{

    private $taxonomyModel;

    /**
     * PlantRepository constructor.
     * @param Application $app
     * @param Taxonomy $taxonomyModel
     * @throws \Exception
     */
    public function __construct(Application $app, Taxonomy $taxonomyModel)
    {
        parent::__construct($app);
        $this->taxonomyModel = $taxonomyModel;
    }

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
        return PlantHerbarium::class;
    }

    /**
     * @param array $input
     * @return Model|void
     */
    public function create($input)
    {
        [$taxonomy_input, $taxonomy_id] = $this->firstOrCreateTaxonomy($input);
        $plant = $this->createPlant($input, $taxonomy_id);
        $this->syncPlantGeneralProperties($taxonomy_input, $plant);
        $this->syncPlantTypeProperties($input, $plant);
        return $plant;
    }

    /**
     * @param array $input
     * @param $id
     * @return Model|void
     */
    public function update($input, $id)
    {
        [$taxonomy_input, $taxonomy_id] = $this->firstOrCreateTaxonomy($input);
        $plant = $this->updatePlant($input, $id, $taxonomy_id);
        $this->syncPlantGeneralProperties($taxonomy_input, $plant);
        $this->syncPlantTypeProperties($input, $plant);
        $this->updateMedia($input, $plant);
        return $plant;
    }


    /**
     * @param $input
     * @param $taxonomy_id
     * @return Model
     */
    private function createPlant($input, $taxonomy_id): Model
    {
        $plant_input = [
            'taxonomy_id' => $taxonomy_id,
            'name' => $input['name'],
            'protection_id' => $input['protection_id'],
            'location_id' => $input['location_id'],
            'organization_id' => $input['organization_id'],
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_ecology_id' => $input['general_ecology_id'] ?? null,
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'general_substrate_lichen_id' => $input['general_substrate_lichen_id'] ?? null,
            'general_substrate_moss_id' => $input['general_substrate_moss_id'] ?? null,
            'general_substrate_diatom_id' => $input['general_substrate_diatom_id'] ?? null,
            'description' => $input['description'] ?? null,
            'habitat_description' => $input['habitat_description'] ?? null,
            'ecology_description' => $input['ecology_description'] ?? null,
            'life_forms' => $input['life_forms'] ?? null,
            'is_flowering' => $input['is_flowering'] ?? 0,
            'flowering_time' => $input['flowering_time'] ?? null,
            'herbarium_number' => $input['herbarium_number'] ?? null,
            'herbarium_index' => $input['herbarium_index'] ?? null,
            'cf' => $input['cf'] ?? 0,
            'sheets_no' => $input['sheets_no'] ?? null,
            'samples_no' => $input['samples_no'] ?? null,
            'tip_qt' => $input['tip_qt'] ?? null,
            'physical_tip_qt' => $input['physical_tip_qt'] ?? null,
        ];
        //store plant
        return parent::create($plant_input);
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
        ];
        //store taxonomy
        $result = $this->taxonomyModel->firstOrCreate($taxonomy_input);
        return [$taxonomy_input, $result->id];
    }

    /**
     * @param array $taxonomy_input
     * @param Model $plant
     */
    private function syncPlantGeneralProperties(array $taxonomy_input, Model $plant): void
    {
        $general_input = array_filter($taxonomy_input, function ($value, $key) {
            return $value !== null; /*and $key !== 'type_description' and $key !== 'plant_id';*/
        }, ARRAY_FILTER_USE_BOTH);

        $plant->generals()->sync($taxonomy_input);
    }

    /**
     * @param $input
     * @param Model $plant
     * @return mixed
     */
    private function syncPlantTypeProperties($input, Model $plant)
    {
        if (!empty($input['plant_types'])) {
            $plant->generals()->sync($input['plant_types']);
        }
    }


    /**
     * @param $input
     * @param $id
     * @param $taxonomy_id
     * @return Builder|Builder[]|Collection|Model
     */
    private function updatePlant($input, $id, $taxonomy_id)
    {
        $plant_input = [
            'taxonomy_id' => $taxonomy_id,
            'name' => $input['name'],
            'protection_id' => $input['protection_id'],
            'location_id' => $input['location_id'],
            'organization_id' => $input['organization_id'],
            'general_phytogeography_id' => $input['general_phytogeography_id'],
            'general_ecology_id' => $input['general_ecology_id'] ?? null,
            'general_habitat_id' => $input['general_habitat_id'] ?? null,
            'general_origin_id' => $input['general_origin_id'] ?? null,
            'general_substrate_lichen_id' => $input['general_substrate_lichen_id'] ?? null,
            'general_substrate_moss_id' => $input['general_substrate_moss_id'] ?? null,
            'general_substrate_diatom_id' => $input['general_substrate_diatom_id'] ?? null,
            'description' => $input['description'] ?? null,
            'habitat_description' => $input['habitat_description'] ?? null,
            'ecology_description' => $input['ecology_description'] ?? null,
            'life_forms' => $input['life_forms'] ?? null,
            'is_flowering' => $input['is_flowering'] ?? 0,
            'flowering_time' => $input['flowering_time'] ?? null,
            'herbarium_number' => $input['herbarium_number'] ?? null,
            'herbarium_index' => $input['herbarium_index'] ?? null,
            'cf' => $input['cf'] ?? 0,
            'sheets_no' => $input['sheets_no'] ?? null,
            'samples_no' => $input['samples_no'] ?? null,
            'tip_qt' => $input['tip_qt'] ?? null,
            'physical_tip_qt' => $input['physical_tip_qt'] ?? null
        ];
        return parent::update($plant_input, $id);
    }


    /**
     * @param $input
     * @param $plant
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
        $model->save();
    }

}
