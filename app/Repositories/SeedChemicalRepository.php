<?php

namespace App\Repositories;

use App\Models\SeedChemical;
use App\Repositories\BaseRepository;

/**
 * Class SeedChemicalRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
*/

class SeedChemicalRepository extends BaseRepository
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
        return SeedChemical::class;
    }
}
