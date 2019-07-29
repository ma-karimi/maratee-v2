<?php

namespace App\Repositories;

use App\Models\CryoBank;
use App\Repositories\BaseRepository;

/**
 * Class CryoBankRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:07 am UTC
*/

class CryoBankRepository extends BaseRepository
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
        return CryoBank::class;
    }
}
