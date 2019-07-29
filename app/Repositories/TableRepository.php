<?php

namespace App\Repositories;

use App\Models\Table;
use App\Repositories\BaseRepository;

/**
 * Class TableRepository
 * @package App\Repositories
 * @version July 20, 2019, 10:43 am UTC
*/

class TableRepository extends BaseRepository
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
        return Table::class;
    }
}
