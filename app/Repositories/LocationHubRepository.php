<?php

namespace App\Repositories;

use App\Models\LocationHub;

/**
 * Class LocationHubRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:29 am UTC
 */
class LocationHubRepository extends BaseRepository
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
        return LocationHub::class;
    }
}
