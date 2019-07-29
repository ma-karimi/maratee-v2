<?php

namespace App\Repositories;

use App\Models\Plantology;
use App\Repositories\BaseRepository;

/**
 * Class PlantologyRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:24 am UTC
*/

class PlantologyRepository extends BaseRepository
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
        return Plantology::class;
    }
}
