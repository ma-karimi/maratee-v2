<?php

namespace App\Repositories;

use App\Models\Character;
use App\Repositories\BaseRepository;

/**
 * Class CharacterRepository
 * @package App\Repositories
 * @version August 13, 2019, 11:01 am UTC
*/

class CharacterRepository extends BaseRepository
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
        return Character::class;
    }
}
