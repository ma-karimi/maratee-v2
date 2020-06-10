<?php

namespace App\Repositories;

use App\Models\CryobankGeneral;

/**
 * Class CryobankGeneralRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:06 am UTC
 */
class CryobankGeneralRepository extends BaseRepository
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
        return CryobankGeneral::class;
    }
}
