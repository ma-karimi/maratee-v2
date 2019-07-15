<?php

namespace App\Repositories;

use App\Models\BotanicalChemical;
use App\Repositories\BaseRepository;

/**
 * Class BotanicalChemicalRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:58 am UTC
*/

class BotanicalChemicalRepository extends BaseRepository
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
        return BotanicalChemical::class;
    }
}
