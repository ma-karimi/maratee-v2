<?php

namespace App\Repositories;

use App\Models\PlantingCondition;
use App\Repositories\BaseRepository;

/**
 * Class PlantingConditionRepository
 * @package App\Repositories
 * @version September 11, 2019, 7:39 am UTC
*/

class PlantingConditionRepository extends BaseRepository
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
        return PlantingCondition::class;
    }
}
