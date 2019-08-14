<?php

namespace App\Repositories;

use App\Models\BlockTrait;
use App\Repositories\BaseRepository;

/**
 * Class BlockTraitRepository
 * @package App\Repositories
 * @version August 13, 2019, 12:55 pm UTC
*/

class BlockTraitRepository extends BaseRepository
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
        return BlockTrait::class;
    }
}
