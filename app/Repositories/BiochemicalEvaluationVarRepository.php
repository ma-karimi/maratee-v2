<?php

namespace App\Repositories;

use App\Models\BiochemicalEvaluationVar;
use App\Repositories\BaseRepository;

/**
 * Class BiochemicalEvaluationVarRepository
 * @package App\Repositories
 * @version October 16, 2019, 5:58 am UTC
*/

class BiochemicalEvaluationVarRepository extends BaseRepository
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
        return BiochemicalEvaluationVar::class;
    }
}
