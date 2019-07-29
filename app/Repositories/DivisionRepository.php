<?php

namespace App\Repositories;

use App\Models\Division;
use App\Repositories\BaseRepository;

/**
 * Class DivisionRepository
 * @package App\Repositories
 * @version July 22, 2019, 12:03 pm UTC
*/

class DivisionRepository extends BaseRepository
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
        return Division::class;
    }
}
