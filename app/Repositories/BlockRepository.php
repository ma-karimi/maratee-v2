<?php

namespace App\Repositories;

use App\Models\Block;
use App\Repositories\BaseRepository;

/**
 * Class BlockRepository
 * @package App\Repositories
 * @version August 13, 2019, 10:38 am UTC
*/

class BlockRepository extends BaseRepository
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
        return Block::class;
    }
}
