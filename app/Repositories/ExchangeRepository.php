<?php

namespace App\Repositories;

use App\Models\Exchange;
use App\Repositories\BaseRepository;

/**
 * Class ExchangeRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:12 am UTC
*/

class ExchangeRepository extends BaseRepository
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
        return Exchange::class;
    }
}
