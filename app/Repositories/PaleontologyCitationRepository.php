<?php

namespace App\Repositories;

use App\Models\PaleontologyCitation;
use App\Repositories\BaseRepository;

/**
 * Class PaleontologyCitationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:27 am UTC
*/

class PaleontologyCitationRepository extends BaseRepository
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
        return PaleontologyCitation::class;
    }
}
