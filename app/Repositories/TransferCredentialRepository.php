<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Models\TransferCredential;
use App\Repositories\BaseRepository;

/**
 * Class TransferCredentialRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:36 am UTC
*/

class TransferCredentialRepository extends BaseRepository
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
        return TransferCredential::class;
    }
}
