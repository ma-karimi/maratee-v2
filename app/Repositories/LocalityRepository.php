<?php

namespace App\Repositories;

use App\Models\Locality;

/**
 * Class LocalityRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:20 am UTC
 */
class LocalityRepository extends BaseRepository
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
        return Locality::class;
    }
}
