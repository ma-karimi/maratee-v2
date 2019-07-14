<?php

namespace App\Repositories;

use App\Models\Herbarium;
use App\Repositories\BaseRepository;

/**
 * Class HerbariumRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:14 am UTC
*/

class HerbariumRepository extends BaseRepository
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
        return Herbarium::class;
    }
}
