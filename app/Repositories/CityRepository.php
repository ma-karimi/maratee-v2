<?php

namespace App\Repositories;

use App\Models\City;

/**
 * Class CityRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:00 am UTC
 */
class CityRepository extends BaseRepository
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
        return City::class;
    }

    public function getRelationFields()
    {
        return ['province'];
    }
}
