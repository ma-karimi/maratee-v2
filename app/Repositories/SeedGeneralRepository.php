<?php

namespace App\Repositories;

use App\Models\SeedGeneral;

/**
 * Class SeedGeneralRepository
 * @package App\Repositories
 * @version October 16, 2019, 10:54 am UTC
 */
class SeedGeneralRepository extends BaseRepository
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
        return SeedGeneral::class;
    }
}
