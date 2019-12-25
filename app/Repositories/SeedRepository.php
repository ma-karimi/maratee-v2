<?php

namespace App\Repositories;

use App\Models\Seed;

/**
 * Class SeedRepository
 * @package App\Repositories
 * @version October 20, 2019, 7:08 am UTC
 */
class SeedRepository extends BaseRepository
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
        return Seed::class;
    }
}
