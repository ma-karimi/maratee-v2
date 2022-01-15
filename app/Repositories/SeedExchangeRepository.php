<?php

namespace App\Repositories;

use App\Models\SeedExchange;
use App\Models\SeedWeight;
use Illuminate\Support\Str;

/**
 * Class SeedExchangeRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class SeedExchangeRepository extends BaseRepository
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
        return SeedExchange::class;
    }

    public function getRelationFields()
    {
        return ['seed_weight.seedCollection', 'seed_weight.collection', 'collection'];
    }

    public function create($input)
    {
        $seedWeight = SeedWeight::find($input['seed_weight_id']);
        $exchanged = request()->get('exchanged_weight');
        $seedExchange = parent::create(array_merge($input, ['seedfruit_weight' => Str::contains($input['specimen_type_name'], 'seed') ? $seedWeight->total_seed_weight - $exchanged : $seedWeight->total_fruit_weight - $exchanged]));
        if (Str::contains($input['specimen_type_name'], 'seed')) {
            $data = ['total_seed_weight' => $seedWeight->total_seed_weight - $exchanged];
        } else {
            $data = ['total_fruit_weight' => $seedWeight->total_fruit_weight - $exchanged];
        }
        $seedWeight->update($data);
        return $seedExchange;
    }
}
