<?php

namespace App\Repositories;

use App\Models\SeedHub;
use App\Repositories\BaseRepository;

/**
 * Class SeedHubRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:21 am UTC
*/

class SeedHubRepository extends BaseRepository
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
        return SeedHub::class;
    }
}
