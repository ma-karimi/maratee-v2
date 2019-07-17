<?php

namespace App\Repositories;

use App\Models\Chemical;
use App\Repositories\BaseRepository;

/**
 * Class ChemicalRepository
 * @package App\Repositories
 * @version July 17, 2019, 5:33 am UTC
*/

class ChemicalRepository extends BaseRepository
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
        return Chemical::class;
    }
}
