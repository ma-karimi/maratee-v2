<?php

namespace App\Repositories;

use App\Models\Village;

/**
 * Class VillageRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:09 am UTC
 */
class VillageRepository extends BaseRepository
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
        return Village::class;
    }
}
