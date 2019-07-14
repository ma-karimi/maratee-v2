<?php

namespace App\Repositories;

use App\Models\AssessmentCollection;
use App\Repositories\BaseRepository;

/**
 * Class AssessmentCollectionRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:36 am UTC
*/

class AssessmentCollectionRepository extends BaseRepository
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
        return AssessmentCollection::class;
    }
}
