<?php

namespace App\Repositories;

use App\Models\Classification;
use App\Repositories\BaseRepository;

/**
 * Class ClassificationRepository
 * @package App\Repositories
 * @version August 13, 2019, 6:22 am UTC
*/

class ClassificationRepository extends BaseRepository
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
        return Classification::class;
    }
}
