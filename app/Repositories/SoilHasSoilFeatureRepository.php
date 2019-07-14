<?php

namespace App\Repositories;

use App\Models\SoilHasSoilFeature;
use App\Repositories\BaseRepository;

/**
 * Class SoilHasSoilFeatureRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:20 am UTC
*/

class SoilHasSoilFeatureRepository extends BaseRepository
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
        return SoilHasSoilFeature::class;
    }
}
