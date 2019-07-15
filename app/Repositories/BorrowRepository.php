<?php

namespace App\Repositories;

use App\Models\Borrow;
use App\Repositories\BaseRepository;

/**
 * Class BorrowRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:39 am UTC
*/

class BorrowRepository extends BaseRepository
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
        return Borrow::class;
    }
}
