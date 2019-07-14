<?php

namespace App\Repositories;

use App\Models\Constituent;
use App\Repositories\BaseRepository;

/**
 * Class ConstituentRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:04 am UTC
*/

class ConstituentRepository extends BaseRepository
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
        return Constituent::class;
    }
}
