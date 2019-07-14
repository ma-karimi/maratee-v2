<?php

namespace App\Repositories;

use App\Models\Paleontology;
use App\Repositories\BaseRepository;

/**
 * Class PaleontologyRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:26 am UTC
*/

class PaleontologyRepository extends BaseRepository
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
        return Paleontology::class;
    }
}
