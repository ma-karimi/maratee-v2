<?php

namespace App\Repositories;

use App\Models\SeedWeight;
use App\Repositories\BaseRepository;

/**
 * Class SeedWeightRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:20 am UTC
*/

class SeedWeightRepository extends BaseRepository
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
        return SeedWeight::class;
    }
}
