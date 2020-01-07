<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="SeedWeight",
 * )
 */
class SeedWeight extends BaseModel
{

    public static $rules = [
        'seed_collection_id' => 'required|exists:seed_collections,id',
        'refrigerator_id' => 'required|exists:seed_generals,id',
        'thousand_fruits_weight' => 'nullable|numeric',
        'thousand_seeds_weight' => 'nullable|numeric',
        'total_fruit_weight' => 'nullable|numeric',
        'total_seed_weight' => 'nullable|numeric',
        'collected_seeds_no' => 'required|numeric',
        'banked' => 'nullable|date'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_weights';
    protected $casts = [
        'thousand_fruits_weight' => 'float',
        'thousand_seeds_weight' => 'float',
        'total_fruit_weight' => 'float',
        'total_seed_weight' => 'float',
    ];

    public function seedCollection()
    {
        return $this->belongsTo(SeedCollection::class);
    }

    public function collection()
    {
        return $this->belongsTo(SeedGeneral::class)->where('type_id', 19);
    }


    /**
     * @return BelongsTo
     */
    public function refrigerator()
    {
        return $this->belongsTo(SeedGeneral::class, 'refrigerator_id')->where('seed_generals.type_id', 24);
    }
}
