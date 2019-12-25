<?php

namespace App\Repositories;

use App\Models\BotanicalIrrigation;

/**
 * Class BotanicalIrrigationRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:56 am UTC
 */
class BotanicalIrrigationRepository extends BaseRepository
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
        return BotanicalIrrigation::class;
    }
}
