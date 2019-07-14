<?php

namespace App\Repositories;

use App\Models\PlantingFactor;
use App\Repositories\BaseRepository;

/**
 * Class PlantingFactorRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
*/

class PlantingFactorRepository extends BaseRepository
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
        return PlantingFactor::class;
    }
}
