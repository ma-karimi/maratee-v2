<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Repositories\BaseRepository;

/**
 * Class ActionHubRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:28 am UTC
*/

class ActionHubRepository extends BaseRepository
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
        return ActionHub::class;
    }
}
