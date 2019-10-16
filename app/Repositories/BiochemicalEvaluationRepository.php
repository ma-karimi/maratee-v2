<?php

namespace App\Repositories;

use App\Models\BiochemicalEvaluation;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class BiochemicalEvaluationRepository
 * @package App\Repositories
 * @version October 16, 2019, 5:58 am UTC
*/

class BiochemicalEvaluationRepository extends BaseRepository
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
        return BiochemicalEvaluation::class;
    }

    public function create($input)
    {
        $biochemical_evaluation=parent::create(Arr::except($input,['value','var_id']));
        $this->setBioChemicalVar($input, $biochemical_evaluation);
        return $biochemical_evaluation->load('vars');
    }
    public function update($input,$id)
    {
        $biochemical_evaluation=parent::update(Arr::except($input,['value','var_id']),$id);
        $this->setBioChemicalVar($input, $biochemical_evaluation);
        return $biochemical_evaluation->load('vars');
    }

    /**
     * @param $input
     * @param Model $biochemical_evaluation
     */
    private function setBioChemicalVar($input, Model $biochemical_evaluation): void
    {
        if (array_key_exists('value',$input)) {
            $biochemical_evaluation->vars()->updateOrCreate([
                'var_id' => $input['var_id'] ?? 1,
                'value' => $input['value']
            ]);
        }
    }
}
