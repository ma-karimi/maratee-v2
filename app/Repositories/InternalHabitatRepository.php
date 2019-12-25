<?php

namespace App\Repositories;

use App\Models\InternalHabitat;

/**
 * Class InternalHabitatRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:12 am UTC
 */
class InternalHabitatRepository extends BaseRepository
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
        return InternalHabitat::class;
    }

}
