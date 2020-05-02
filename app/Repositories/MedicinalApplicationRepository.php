<?php

namespace App\Repositories;

use App\Models\MedicinalApplication;

/**
 * Class MedicinalApplicationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalApplicationRepository extends BaseRepository
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
        return MedicinalApplication::class;
    }


    public function update($input, $id)
    {
        $model = parent::update($this->applicationData($input), $id);
        $this->storeRelations($input, $model);

        return $model;
    }

    /**
     * @param $input
     * @return array
     */
    private function applicationData($input): array
    {
        return [
            'taxonomy_id' => $input['taxonomy_id'],
            'traditional_iranian_medicine' => $input['traditional_iranian_medicine'] ?? null,
            'natural_drug' => $input['natural_drug'] ?? null,
            'inherbal_medicine_store' => $input['inherbal_medicine_store'] ?? null,
            'hygienic_cosmetic_industry_id' => $input['hygienic_cosmetic_industry_id'] ?? 0,
            'exporting' => $input['exporting'] ?? null,
            'importing' => $input['importing'] ?? null,
            'cultivated_area_id' => $input['cultivated_area_id'] ?? 0,
            'has_ground_part' => $input['has_ground_part'] ?? 0,
            'has_aerial_part' => $input['has_aerial_part'] ?? 0,
            'has_importing' => $input['has_importing'] ?? 0,
            'has_exporting' => $input['has_exporting'] ?? 0,
            'general_origin_id' => $input['general_origin_id'] ?? null,
        ];
    }

    /**
     * @param $input
     * @param $model
     */
    private function storeRelations($input, $model): void
    {
        $this->createHub($model->id, 'foodIndustries', request()->filled('food_industries') ? $input['food_industries'] : []);
        $this->createHub($model->id, 'otherIndustries', request()->filled('other_industries') ? $input['other_industries'] : []);
        $this->createHub($model->id, 'industrialPotentials', request()->filled('industrial_potentials') ? $input['industrial_potentials'] : []);
        $this->storeAerialParts($input, $model);
        $this->storeUndergroundParts($input, $model);

    }

    public function create($input)
    {
        $model = parent::create($this->applicationData($input));
        $this->storeRelations($input, $model);


        return $model;

    }

    /**
     * @return array
     */
    public function getRelationFields(): array
    {
        return ['taxonomy', 'aerialTypes', 'undergroundParts', 'origin', 'foodIndustries', 'otherIndustries', 'industrialPotentials'];
    }


    private function storeAerialParts($input, $medicinal)
    {
        $aerialTypes = request()->filled('aerialTypes') ? $input['aerialTypes'] : [];
        $this->createHub($medicinal->id, 'aerialTypes', $aerialTypes);
    }


    private function storeUndergroundParts($input, $medicinal)
    {
        $undergroundParts = request()->filled('groundParts') ? $input['groundParts'] : [];
        $this->createHub($medicinal->id, 'undergroundParts', $undergroundParts);
    }
}
