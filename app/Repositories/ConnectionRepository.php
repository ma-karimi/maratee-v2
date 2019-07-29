<?php

namespace App\Repositories;

use App\Models\Connection;
use App\Repositories\BaseRepository;

/**
 * Class ConnectionRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:06 am UTC
*/

class ConnectionRepository extends BaseRepository
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
        return Connection::class;
    }
}
