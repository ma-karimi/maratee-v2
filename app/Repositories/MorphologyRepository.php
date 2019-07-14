<?php

namespace App\Repositories;

use App\Models\Morphology;
use App\Repositories\BaseRepository;

/**
 * Class MorphologyRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:27 am UTC
*/

class MorphologyRepository extends BaseRepository
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
        return Morphology::class;
    }
}
