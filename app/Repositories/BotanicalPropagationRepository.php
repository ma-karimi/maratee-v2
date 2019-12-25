<?php

namespace App\Repositories;

use App\Models\BotanicalPropagation;

/**
 * Class BotanicalPropagationRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:58 am UTC
 */
class BotanicalPropagationRepository extends BaseRepository
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
        return BotanicalPropagation::class;
    }
}
