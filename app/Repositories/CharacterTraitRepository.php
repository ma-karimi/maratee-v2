<?php

namespace App\Repositories;

use App\Models\CharacterTrait;
use App\Repositories\BaseRepository;

/**
 * Class CharacterTraitRepository
 * @package App\Repositories
 * @version August 13, 2019, 11:18 am UTC
*/

class CharacterTraitRepository extends BaseRepository
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
        return CharacterTrait::class;
    }
}
