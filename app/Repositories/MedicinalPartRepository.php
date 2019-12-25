<?php

namespace App\Repositories;

use App\Models\MedicinalPart;

/**
 * Class MedicinalPartRepository
 * @package App\Repositories
 * @version August 27, 2019, 6:19 am UTC
 */
class MedicinalPartRepository extends BaseRepository
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
        return MedicinalPart::class;
    }
}
