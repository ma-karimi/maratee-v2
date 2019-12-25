<?php

namespace App\Repositories;

use App\Models\GeologyAge;

/**
 * Class GeologyAgeRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:13 am UTC
 */
class GeologyAgeRepository extends BaseRepository
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
        return GeologyAge::class;
    }
}
