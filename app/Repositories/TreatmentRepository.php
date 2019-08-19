<?php

namespace App\Repositories;

use App\Models\Treatment;

/**
 * Class TreatmentRepository
 * @package App\Repositories
 * @version July 14, 2019, 9:41 am UTC
 */
class TreatmentRepository extends BaseRepository
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
        return Treatment::class;
    }
}
