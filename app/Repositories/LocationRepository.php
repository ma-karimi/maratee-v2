<?php

namespace App\Repositories;

use App\Models\Location;

/**
 * Class LocationRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:07 am UTC
 */
class LocationRepository extends BaseRepository
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
        return Location::class;
    }
}
