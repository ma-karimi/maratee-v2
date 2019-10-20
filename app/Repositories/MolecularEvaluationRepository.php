<?php

namespace App\Repositories;

use App\Models\MolecularEvaluation;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class MolecularEvaluationRepository
 * @package App\Repositories
 * @version October 20, 2019, 6:18 am UTC
*/

class MolecularEvaluationRepository extends BaseRepository
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
        return MolecularEvaluation::class;
    }

    public function create($input)
    {
        $molecular_evaluation=parent::create(Arr::except($input,['value','var_id']));
        $this->setMolecularEvaluationVar($input, $molecular_evaluation);
        return $molecular_evaluation->load('vars');
    }
    public function update($input,$id)
    {
        $molecular_evaluation=parent::update(Arr::except($input,['value','var_id']),$id);
        $this->setMolecularEvaluationVar($input, $molecular_evaluation);
        return $molecular_evaluation->load('vars');
    }

    /**
     * @param $input
     * @param Model $molecular_evaluation
     */
    private function setMolecularEvaluationVar($input, Model $molecular_evaluation): void
    {
        if (array_key_exists('value',$input)) {
            $molecular_evaluation->vars()->updateOrCreate([
                'var_id' => $input['var_id'] ?? 1,
                'value' => $input['value']
            ]);
        }
    }
}
