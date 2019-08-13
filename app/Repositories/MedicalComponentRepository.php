<?php

namespace App\Repositories;

use App\Models\Component;
use App\Models\Constituent;
use App\Models\MedicalComponent;
use App\Repositories\BaseRepository;

/**
 * Class MedicalComponentRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:04 am UTC
*/

class MedicalComponentRepository extends BaseRepository
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
        return MedicalComponent::class;
    }
}
