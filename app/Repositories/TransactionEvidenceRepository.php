<?php

namespace App\Repositories;

use App\Models\TransactionEvidence;
use App\Repositories\BaseRepository;

/**
 * Class TransactionEvidenceRepository
 * @package App\Repositories
 * @version September 2, 2019, 9:26 am UTC
*/

class TransactionEvidenceRepository extends BaseRepository
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
        return TransactionEvidence::class;
    }
}
