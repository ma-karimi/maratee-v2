<?php

namespace App\Repositories;

use App\Models\Germination;

/**
 * Class GerminationRepository
 * @package App\Repositories
 * @version August 13, 2019, 5:33 am UTC
 */
class GerminationRepository extends BaseRepository
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
        return Germination::class;
    }
}
