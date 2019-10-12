<?php

namespace App\Repositories;

use App\Models\SeedCollection;
use App\Repositories\BaseRepository;

/**
 * Class SeedCollectionRepository
 * @package App\Repositories
 * @version October 12, 2019, 11:34 am UTC
*/

class SeedCollectionRepository extends BaseRepository
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
        return SeedCollection::class;
    }
}
