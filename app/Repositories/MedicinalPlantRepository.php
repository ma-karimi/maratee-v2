<?php

namespace App\Repositories;

use App\Models\{MedicinalPlant};
use Illuminate\Support\Arr;

/**
 * Class MedicinalPlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalPlantRepository extends BaseRepository
{
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
        return MedicinalPlant::class;
    }

    public function create($input)
    {
        $model = parent::create(Arr::only($input, $this->medicinalData()));
        $this->storeMetabolites($input, $model);
        $this->storeProperties($input, $model);
        $this->storeAerialParts($input, $model);


        return $model;
    }

    /**
     * @return array
     */
    private function medicinalData(): array
    {
        return ['taxonomy_id', 'ground_part_id', 'general_origin_id', 'wooden_id', 'properties_description', 'local_name'];
    }

    private function storeMetabolites($input, $medicinal)
    {
        $metabolites = request()->filled('metabolites') ? $input['metabolites'] : [];
        $this->createHub($medicinal->id, 'secondaryMetabolites', $metabolites);
    }

    private function storeProperties($input, $medicinal)
    {
        $properties = request()->filled('properties') ? $input['properties'] : [];
        $this->createHub($medicinal->id, 'properties', $properties);
    }

    private function storeAerialParts($input, $medicinal)
    {
        $aerialTypes = request()->filled('aerialTypes') ? $input['aerialTypes'] : [];
        $this->createHub($medicinal->id, 'aerialTypes', $aerialTypes);
    }

    public function update($input, $id)
    {
        $model = parent::update(Arr::only($input, $this->medicinalData()), $id);
        $this->storeMetabolites($input, $model);
        $this->storeProperties($input, $model);
        $this->storeAerialParts($input, $model);

        return $model;
    }

    /**
     * @return array
     */
    public function getRelationFields(): array
    {
        return ['taxonomy', 'aerialTypes', 'groundType', 'origin', 'secondaryMetabolites', 'properties'];
    }

}
