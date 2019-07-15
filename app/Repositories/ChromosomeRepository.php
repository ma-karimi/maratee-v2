<?php

namespace App\Repositories;

use App\Models\Chromosome;
use App\Repositories\BaseRepository;

/**
 * Class ChromosomeRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:59 am UTC
*/

class ChromosomeRepository extends BaseRepository
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
        return Chromosome::class;
    }
}
