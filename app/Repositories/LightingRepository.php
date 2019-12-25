<?php

namespace App\Repositories;

use App\Models\Lighting;

/**
 * Class LightingRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:17 am UTC
 */
class LightingRepository extends BaseRepository
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
        return Lighting::class;
    }
}
