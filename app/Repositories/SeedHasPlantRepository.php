<?php

namespace App\Repositories;

use App\Models\SeedHasPlant;
use App\Repositories\BaseRepository;

/**
 * Class SeedHasPlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
*/

class SeedHasPlantRepository extends BaseRepository
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
        return SeedHasPlant::class;
    }
}
