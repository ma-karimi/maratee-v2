<?php

namespace App\Repositories;

use App\Models\Method;

/**
 * Class MethodRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:24 am UTC
 */
class MethodRepository extends BaseRepository
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
        return Method::class;
    }
}
