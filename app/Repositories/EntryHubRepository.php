<?php

namespace App\Repositories;

use App\Models\EntryHub;
use App\Repositories\BaseRepository;

/**
 * Class EntryHubRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:11 am UTC
*/

class EntryHubRepository extends BaseRepository
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
        return EntryHub::class;
    }
}
