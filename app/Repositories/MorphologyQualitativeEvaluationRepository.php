<?php

namespace App\Repositories;

use App\Models\MorphologyQualitativeEvaluation;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class MorphologyQualitativeEvaluationRepository
 * @package App\Repositories
 * @version October 20, 2019, 8:47 am UTC
*/

class MorphologyQualitativeEvaluationRepository extends BaseRepository
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
        return MorphologyQualitativeEvaluation::class;
    }

    public function create($input)
    {
        $morphology_qualitative_evaluation=parent::create(Arr::except($input,['value','var_id']));
        $this->setMorphologyVar($input, $morphology_qualitative_evaluation);
        return $morphology_qualitative_evaluation->load('vars');
    }
    public function update($input,$id)
    {
        $morphology_qualitative_evaluation=parent::update(Arr::except($input,['value','var_id']),$id);
        $this->setMorphologyVar($input, $morphology_qualitative_evaluation);
        return $morphology_qualitative_evaluation->load('vars');
    }

    /**
     * @param $input
     * @param Model $biochemical_evaluation
     */
    private function setMorphologyVar($input, Model $biochemical_evaluation): void
    {
        if (array_key_exists('value',$input)) {
            $biochemical_evaluation->vars()->updateOrCreate([
                'var_id' => $input['var_id'] ?? 1,
                'value' => $input['value']
            ]);
        }
    }
}
