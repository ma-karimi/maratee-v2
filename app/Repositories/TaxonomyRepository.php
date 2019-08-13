<?php

namespace App\Repositories;

use App\Models\Taxonomy;
use App\Repositories\BaseRepository;

/**
 * Class TaxonomyRepository
 * @package App\Repositories
 * @version August 13, 2019, 6:12 am UTC
*/

class TaxonomyRepository extends BaseRepository
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
        return Taxonomy::class;
    }
}
