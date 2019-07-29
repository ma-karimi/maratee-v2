<?php

namespace App\Repositories;

use App\Models\Plant;
use App\Repositories\BaseRepository;

/**
 * Class PlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
*/

class PlantRepository extends BaseRepository
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
        return Plant::class;
    }
}
