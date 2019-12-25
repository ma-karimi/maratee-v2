<?php

namespace App\Repositories;

use App\Models\MorphologyQuantitativeEvaluation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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

    public function create($input)
    {
        $morphology_quantitative_evaluation = parent::create(Arr::except($input, ['value', 'var_id']));
        $this->setMorphologyVar($input, $morphology_quantitative_evaluation);
        return $morphology_quantitative_evaluation->load('vars');
    }

    /**
     * @param $input
     * @param Model $biochemical_evaluation
     */
    private function setMorphologyVar($input, Model $biochemical_evaluation): void
    {
        if (array_key_exists('value', $input)) {
            $biochemical_evaluation->vars()->updateOrCreate([
                'var_id' => $input['var_id'] ?? 1,
                'value' => $input['value']
            ]);
        }
    }

    public function update($input, $id)
    {
        $morphology_quantitative_evaluation = parent::update(Arr::except($input, ['value', 'var_id']), $id);
        $this->setMorphologyVar($input, $morphology_quantitative_evaluation);
        return $morphology_quantitative_evaluation->load('vars');
    }
}
