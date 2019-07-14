<?php

namespace App\Repositories;

use App\Models\Botanical;
use App\Repositories\BaseRepository;

/**
 * Class BotanicalRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:54 am UTC
*/

class BotanicalRepository extends BaseRepository
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
        return Botanical::class;
    }
}
