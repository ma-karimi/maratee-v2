<?php

namespace App\Repositories;

use App\Models\Protection;
use App\Repositories\BaseRepository;

/**
 * Class ProtectionRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:24 am UTC
*/

class ProtectionRepository extends BaseRepository
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
        return Protection::class;
    }
}
