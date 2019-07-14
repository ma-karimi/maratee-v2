<?php

namespace App\Repositories;

use App\Models\HerbariumAppendix;
use App\Repositories\BaseRepository;

/**
 * Class HerbariumAppendixRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:14 am UTC
*/

class HerbariumAppendixRepository extends BaseRepository
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
        return HerbariumAppendix::class;
    }
}
