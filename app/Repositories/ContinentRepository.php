<?php

namespace App\Repositories;

use App\Models\Continent;

/**
 * Class ContinentRepository
 * @package App\Repositories
 * @version July 14, 2019, 9:32 am UTC
 */
class ContinentRepository extends BaseRepository
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
        return Continent::class;
    }
}
