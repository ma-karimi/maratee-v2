<?php

namespace App\Repositories;

use App\Models\PaleontologyAction;
use App\Repositories\BaseRepository;

/**
 * Class PaleontologyActionRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:26 am UTC
*/

class PaleontologyActionRepository extends BaseRepository
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
        return PaleontologyAction::class;
    }
}
