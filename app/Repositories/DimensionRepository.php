<?php

namespace App\Repositories;

use App\Models\Dimension;
use App\Repositories\BaseRepository;

/**
 * Class DimensionRepository
 * @package App\Repositories
 * @version August 13, 2019, 1:00 pm UTC
*/

class DimensionRepository extends BaseRepository
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
        return Dimension::class;
    }
}
