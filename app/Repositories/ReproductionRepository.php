<?php

namespace App\Repositories;

use App\Models\Reproduction;
use App\Repositories\BaseRepository;

/**
 * Class ReproductionRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
*/

class ReproductionRepository extends BaseRepository
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
        return Reproduction::class;
    }
}
