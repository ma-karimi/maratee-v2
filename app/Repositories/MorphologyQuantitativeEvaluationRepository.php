<?php

namespace App\Repositories;

use App\Models\MorphologyQuantitativeEvaluation;
use App\Models\MorphologyVariable;

/**
 * Class MorphologyQuantitativeEvaluationRepository
 * @package App\Repositories
 * @version October 20, 2019, 10:05 am UTC
 */
class MorphologyQuantitativeEvaluationRepository extends BaseRepository
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
        return MorphologyQuantitativeEvaluation::class;
    }

    public function storeVariable($input, $id)
    {
        MorphologyVariable::where(
            [
                'morphology_type' => MorphologyQuantitativeEvaluation::class,
                'morphology_id' => $id
            ]
        )
            ->whereNotIn('seed_general_id', collect($input)->pluck('seed_general_id')->all())
            ->delete();

        if (!empty($input) && count($input)) {
            foreach ($input as $item) {
                MorphologyVariable::updateOrCreate(
                    [
                        'morphology_type' => MorphologyQuantitativeEvaluation::class,
                        'morphology_id' => $id,
                        'seed_general_id' => $item['seed_general_id']
                    ],
                    [
                        'value' => $item['value']
                    ]
                );
            }
        }
    }
}
