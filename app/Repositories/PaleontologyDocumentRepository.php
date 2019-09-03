<?php

namespace App\Repositories;

use App\Models\PaleontologyDocument;
use App\Repositories\BaseRepository;

/**
 * Class PaleontologyDocumentRepository
 * @package App\Repositories
 * @version September 3, 2019, 4:20 am UTC
*/

class PaleontologyDocumentRepository extends BaseRepository
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
        return PaleontologyDocument::class;
    }
}
