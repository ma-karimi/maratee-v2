<?php

namespace App\Repositories;

use App\Models\Place;


/**
 * Class PlaceRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
*/

class PlaceRepository extends BaseRepository
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
        return Place::class;
    }
}
