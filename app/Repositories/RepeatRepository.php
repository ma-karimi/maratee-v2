<?php

namespace App\Repositories;

use App\Models\Repeat;

/**
 * Class RepeatRepository
 * @package App\Repositories
 * @version August 13, 2019, 9:57 am UTC
 */
class RepeatRepository extends BaseRepository
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
        return Repeat::class;
    }
}
