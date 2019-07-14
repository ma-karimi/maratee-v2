<?php

namespace App\Repositories;

use App\Models\TechnologyCollection;
use App\Repositories\BaseRepository;

/**
 * Class TechnologyCollectionRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:10 am UTC
*/

class TechnologyCollectionRepository extends BaseRepository
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
        return TechnologyCollection::class;
    }
}
