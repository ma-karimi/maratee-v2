<?php

namespace App\Repositories;

use App\Models\SeedExchange;
use App\Models\SeedWeight;
use Illuminate\Support\Facades\Log;
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
        $seedContain = Str::contains($input['specimen_type_name'], 'seed');
        $seedExchange = parent::create(array_merge($input, ['seedfruit_weight' => $seedContain ? $seedWeight->total_seed_weight - $exchanged : $seedWeight->total_fruit_weight - $exchanged, 'type' => $seedContain ? 'total_seed_weight' : 'total_fruit_weight']));
        if ($seedContain) {
            $data = ['total_seed_weight' => $seedWeight->total_seed_weight - $exchanged];
        } else {
            $data = ['total_fruit_weight' => $seedWeight->total_fruit_weight - $exchanged];
        }
        $seedWeight->update($data);
        return $seedExchange;
    }

    public function delete($id)
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);

        $seedWeight = SeedWeight::find($model->seed_weight_id);
        Log::info($seedWeight);
        $seedWeight->increment($model->type, $model->exchanged_weight);
        Log::info([$model->type, $model->exchanged_weight]);
        return $model->delete();
    }
}
