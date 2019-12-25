<?php

namespace App\Repositories;

use App\Models\Group;

/**
 * Class GroupRepository
 * @package App\Repositories
 * @version July 20, 2019, 10:45 am UTC
 */
class GroupRepository extends BaseRepository
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
        return Group::class;
    }
}
