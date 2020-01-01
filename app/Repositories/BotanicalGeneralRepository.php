<?php

namespace App\Repositories;

use App\Models\BotanicalGeneral;

/**
 * Class BotanicalGeneralRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:55 am UTC
 */
class BotanicalGeneralRepository extends BaseRepository
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
        return BotanicalGeneral::class;
    }
}
