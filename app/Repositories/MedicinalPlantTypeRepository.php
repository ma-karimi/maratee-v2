<?php

namespace App\Repositories;

use App\Models\MedicinalPlantType;

/**
 * Class MedicinalPlantTypeRepository
 * @package App\Repositories
 * @version August 29, 2019, 10:06 am UTC
*/

class MedicinalPlantTypeRepository extends BaseRepository
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
        return MedicinalPlantType::class;
    }
}
