<?php

namespace App\Repositories;

use App\Models\Technology;

/**
 * Class TechnologyCollectionRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:10 am UTC
 */
class TechnologyRepository extends BaseRepository
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
        return Technology::class;
    }
}
