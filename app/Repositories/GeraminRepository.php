<?php

namespace App\Repositories;

use App\Models\Geramin;
use App\Repositories\BaseRepository;

/**
 * Class GeraminRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:14 am UTC
*/

class GeraminRepository extends BaseRepository
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
        return Geramin::class;
    }
}
