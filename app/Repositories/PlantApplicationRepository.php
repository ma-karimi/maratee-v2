<?php

namespace App\Repositories;

use App\Models\HerbariumApplication;


/**
 * Class PlantingApplicationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
*/

class PlantApplicationRepository extends BaseRepository
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
        return HerbariumApplication::class;
    }
}
