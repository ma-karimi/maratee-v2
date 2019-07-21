<?php

namespace App\Repositories;

use App\Models\Transition;
use App\Repositories\BaseRepository;

/**
 * Class TransitionRepository
 * @package App\Repositories
 * @version July 20, 2019, 10:35 am UTC
*/

class TransitionRepository extends BaseRepository
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
        return Transition::class;
    }
}
