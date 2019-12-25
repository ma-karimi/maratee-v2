<?php

namespace App\Repositories;

use App\Models\ActorHub;

/**
 * Class ActorHubRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:28 am UTC
 */
class ActorHubRepository extends BaseRepository
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
        return ActorHub::class;
    }
}
