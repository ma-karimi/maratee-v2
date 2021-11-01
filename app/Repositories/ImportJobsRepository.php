<?php

namespace App\Repositories;

use App\Models\ImportJobs;

/**
 * Class MorphologyQuantitativeEvaluationVarRepository
 * @package App\Repositories
 * @version October 20, 2019, 10:06 am UTC
 */
class ImportJobsRepository extends BaseRepository
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
        return ImportJobs::class;
    }
}
