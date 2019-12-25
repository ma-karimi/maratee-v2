<?php

namespace App\Repositories;

use App\Models\Actor;

/**
 * Class AuthorRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:38 am UTC
 */
class ActorRepository extends BaseRepository
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
        return Actor::class;
    }
}
