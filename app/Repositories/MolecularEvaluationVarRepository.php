<?php

namespace App\Repositories;

use App\Models\MolecularEvaluationVar;
use App\Repositories\BaseRepository;

/**
 * Class MolecularEvaluationVarRepository
 * @package App\Repositories
 * @version October 20, 2019, 6:32 am UTC
*/

class MolecularEvaluationVarRepository extends BaseRepository
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
        return MolecularEvaluationVar::class;
    }
}
