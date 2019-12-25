<?php

namespace App\Repositories;

use App\Models\Irrigation;

/**
 * Class IrrigationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:15 am UTC
 */
class IrrigationRepository extends BaseRepository
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
        return Irrigation::class;
    }
}
