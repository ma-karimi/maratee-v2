<?php

namespace App\Repositories;

use App\Models\Plant;
use Illuminate\Container\Container as Application;

/**
 * Class PlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class PlantRepository extends BaseRepository
{

    private $taxonomyRepository;

    /**
     * PlantRepository constructor.
     * @param Application $app
     * @param TaxonomyRepository $taxonomyRepository
     * @throws \Exception
     */
    public function __construct(Application $app, TaxonomyRepository $taxonomyRepository)
    {
        parent::__construct($app);
        $this->taxonomyRepository = $taxonomyRepository;
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
        return Plant::class;
    }

    /**
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function create($input)
    {
        $plant = $this->createPlant($input);
        $taxonomy_input = $this->createTaxonomy($input, $plant);
        $this->syncPlantProperties($taxonomy_input, $plant);
        $this->syncPlantTypeProperties($input, $plant);
        $this->syncPlantSubSpeciesProperties($input, $plant);
        return $plant;
    }

    /**
     * @param array $input
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function update($input, $id)
    {
        $plant = $this->updatePlant($input, $id);
        $taxonomy_input = $this->updatePlantTaxonomy($input, $plant);
        $this->syncPlantProperties($taxonomy_input, $plant);
        $this->syncPlantTypeProperties($input, $plant);
        $this->syncPlantSubSpeciesProperties($input, $plant);
        $this->updateMedia($input, $plant);
        return $plant;
    }


    /**
     * @param $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function createPlant($input): \Illuminate\Database\Eloquent\Model
    {
        $plant_input = [
            'name' => $input['name'],
            'protection_id' => $input['protection_id'],
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
            'is_flowering' => $input['is_flowering'] ?? null,
            'flowering_time' => $input['is_flowering'] ?? null,
        ];
        //store plant
        return parent::create($plant_input);
    }

    /**
     * @param $input
     * @param \Illuminate\Database\Eloquent\Model $plant
     * @return array
     */
    private function createTaxonomy($input, \Illuminate\Database\Eloquent\Model $plant): array
    {
        $taxonomy_input = [
            'family_id' => $input['family_id'],
            'genus_id' => $input['genus_id'] ?? null,
            'species_id' => $input['species_id'] ?? null,
            'variety_id' => $input['variety_id'] ?? null,
            'type_description' => $input['type_description'] ?? null,
        ];
        $taxonomy_input['plant_id'] = $plant->id;
        //store taxonomy
        $this->taxonomyRepository->create($taxonomy_input);
        return $taxonomy_input;
    }

    /**
     * @param array $taxonomy_input
     * @param \Illuminate\Database\Eloquent\Model $plant
     */
    private function syncPlantProperties(array $taxonomy_input, \Illuminate\Database\Eloquent\Model $plant): void
    {
        $general_input = array_filter($taxonomy_input, function ($value, $key) {
            return $value !== null and $key !== 'type_description' and $key !== 'plant_id';
        }, ARRAY_FILTER_USE_BOTH);

        $plant->generals()->sync($general_input);
    }

    /**
     * @param $input
     * @param \Illuminate\Database\Eloquent\Model $plant
     * @return mixed
     */
    private function syncPlantTypeProperties($input, \Illuminate\Database\Eloquent\Model $plant)
    {
        if (!empty($input['plant_types'])) {
            $plant->generals()->sync($input['plant_types']);
        }
    }

    /**
     * @param $input
     * @param \Illuminate\Database\Eloquent\Model $plant
     */
    private function syncPlantSubSpeciesProperties($input, \Illuminate\Database\Eloquent\Model $plant): void
    {
        if (isset($input['subspecies_ids'])) {
            $plant->generals()->sync($input['subspecies_ids']);
        }
    }

    /**
     * @param $input
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private function updatePlant($input, $id)
    {
        $plant_input = [
            'name' => $input['name'],
            'protection_id' => $input['protection_id'],
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
            'is_flowering' => $input['is_flowering'] ?? null,
            'flowering_time' => $input['is_flowering'] ?? null,
        ];
        return parent::update($plant_input, $id);
    }

    /**
     * @param $input
     * @param $plant
     * @return array
     */
    private function updatePlantTaxonomy($input, $plant): array
    {
        $taxonomy_input = [
            'family_id' => $input['family_id'],
            'genus_id' => $input['genus_id'] ?? null,
            'species_id' => $input['species_id'] ?? null,
            'variety_id' => $input['variety_id'] ?? null,
            'type_description' => $input['type_description'] ?? null,
        ];
        $plant->taxonomy->update($taxonomy_input);
        return $taxonomy_input;
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
