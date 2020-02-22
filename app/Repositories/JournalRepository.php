<?php

namespace App\Repositories;

use App\Models\Journal;

/**
 * Class JournalRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:33 am UTC
 */
class JournalRepository extends BaseRepository
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
        return Journal::class;
    }
}
