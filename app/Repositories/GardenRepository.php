<?php

namespace App\Repositories;

use App\Models\Garden;
use App\Repositories\BaseRepository;

/**
 * Class GardenRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:12 am UTC
*/

class GardenRepository extends BaseRepository
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
        return Garden::class;
    }
}
