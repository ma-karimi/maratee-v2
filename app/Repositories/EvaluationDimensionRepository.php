<?php

namespace App\Repositories;

use App\Models\EvaluationDimension;
use App\Repositories\BaseRepository;

/**
 * Class EvaluationDimensionRepository
 * @package App\Repositories
 * @version August 14, 2019, 4:18 am UTC
*/

class EvaluationDimensionRepository extends BaseRepository
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
        return EvaluationDimension::class;
    }
}
