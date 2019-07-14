<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Repositories\BaseRepository;

/**
 * Class OrganizationRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:08 am UTC
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
