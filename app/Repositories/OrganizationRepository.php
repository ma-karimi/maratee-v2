<?php

namespace App\Repositories;

use App\Models\Organization;

/**
 * Class OrganizationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:27 am UTC
 */
class OrganizationRepository extends BaseRepository
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
        return Organization::class;
    }
}
