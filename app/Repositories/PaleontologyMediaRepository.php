<?php

namespace App\Repositories;

use App\Models\PaleontologyMedia;
use App\Repositories\BaseRepository;

/**
 * Class PaleontologyMediaRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:26 am UTC
*/

class PaleontologyMediaRepository extends BaseRepository
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
        return PaleontologyMedia::class;
    }
}
