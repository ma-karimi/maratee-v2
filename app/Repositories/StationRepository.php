<?php

namespace App\Repositories;

use App\Models\Station;
use App\Repositories\BaseRepository;

/**
 * Class StationRepository
 * @package App\Repositories
 * @version August 13, 2019, 10:13 am UTC
*/

class StationRepository extends BaseRepository
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
        return Station::class;
    }
}
