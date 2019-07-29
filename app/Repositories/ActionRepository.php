<?php

namespace App\Repositories;

use App\Models\Action;
use App\Repositories\BaseRepository;

/**
 * Class ActionRepository
 * @package App\Repositories
 * @version July 14, 2019, 9:55 am UTC
*/

class ActionRepository extends BaseRepository
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
        return Action::class;
    }
}
