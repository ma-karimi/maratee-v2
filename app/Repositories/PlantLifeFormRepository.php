<?php

namespace App\Repositories;

use App\Models\PlantLifeForm;
use App\Repositories\BaseRepository;

/**
 * Class PlantLifeFormRepository
 * @package App\Repositories
 * @version August 25, 2019, 7:09 am UTC
*/

class PlantLifeFormRepository extends BaseRepository
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
        return PlantLifeForm::class;
    }
}
