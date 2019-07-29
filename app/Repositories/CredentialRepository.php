<?php

namespace App\Repositories;

use App\Models\Credential;
use App\Repositories\BaseRepository;

/**
 * Class CredentialRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:06 am UTC
*/

class CredentialRepository extends BaseRepository
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
        return Credential::class;
    }
}
