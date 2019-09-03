<?php

namespace App\Repositories;

use App\Models\ActionHubDocument;
use App\Repositories\BaseRepository;

/**
 * Class ActionHubDocumentRepository
 * @package App\Repositories
 * @version September 3, 2019, 5:22 am UTC
*/

class ActionHubDocumentRepository extends BaseRepository
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
        return ActionHubDocument::class;
    }
}
