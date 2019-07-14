<?php

namespace App\Repositories;

use App\Models\BotanicalGardenAction;
use App\Repositories\BaseRepository;

/**
 * Class BotanicalGardenActionRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:55 am UTC
*/

class BotanicalGardenActionRepository extends BaseRepository
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
        return BotanicalGardenAction::class;
    }
}
