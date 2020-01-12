<?php

namespace App\Repositories;

use App\Models\BotanicalGarden;
use Illuminate\Support\Arr;

/**
 * Class BotanicalGardenRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:56 am UTC
 */
class BotanicalGardenRepository extends BaseRepository
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
        return BotanicalGarden::class;
    }

    public function create($input)
    {
        $item = parent::create(Arr::except($input, ['entrances']));
        $this->createHub($item->id, 'entrances', $input['entrances']);

        return $item;
    }
    public function update($input, $id)
    {
        $item = parent::update(Arr::except($input, ['entrances']), $id);
        $this->createHub($item->id, 'entrances', $input['entrances']);

        return $item;
    }
}
