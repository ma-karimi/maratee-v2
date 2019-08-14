<?php

namespace App\Repositories;

use App\Models\TraitValue;
use App\Repositories\BaseRepository;

/**
 * Class TraitValueRepository
 * @package App\Repositories
 * @version August 13, 2019, 12:20 pm UTC
*/

class TraitValueRepository extends BaseRepository
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
        return TraitValue::class;
    }
}
