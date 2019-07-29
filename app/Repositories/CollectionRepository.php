<?php

namespace App\Repositories;

use App\Models\Collection;
use App\Repositories\BaseRepository;

/**
 * Class CollectionRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:00 am UTC
*/

class CollectionRepository extends BaseRepository
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
        return Collection::class;
    }
}
