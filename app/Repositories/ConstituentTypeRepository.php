<?php

namespace App\Repositories;

use App\Models\ConstituentType;

/**
 * Class ConstituentTypeRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:04 am UTC
 */
class ConstituentTypeRepository extends BaseRepository
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
        return ConstituentType::class;
    }
}
