<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\BaseRepository;

/**
 * Class evaluationRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:35 am UTC
*/

class EvaluationRepository extends BaseRepository
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
        return Evaluation::class;
    }
}
