<?php

namespace App\Repositories;

use App\Models\LifeForm;

/**
 * Class LifeFormRepository
 * @package App\Repositories
 * @version August 25, 2019, 6:13 am UTC
 */
class LifeFormRepository extends BaseRepository
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
        return LifeForm::class;
    }
}
