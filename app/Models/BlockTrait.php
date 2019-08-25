<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="BlockTrait",
 *            required={"block_id","soil_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="block_id", type="integer"),
 * 			@SWG\Property(property="soil_id", type="integer"),
 * 			@SWG\Property(property="water_source", type="string"),
 * 			@SWG\Property(property="irrigation_system", type="string"),
 * 			@SWG\Property(property="irrigation_circuit", type="string"),
 * 			@SWG\Property(property="irrigation_time", type="string"),
 * 			@SWG\Property(property="flow_rate"),
 * 			@SWG\Property(property="water_ph"),
 * 			@SWG\Property(property="water_ec"),
 * 			@SWG\Property(property="excel_url", type="string"),
 *        )
 */
class BlockTrait extends BaseModel
{
    public static $rules = [
        'block_id' => 'required|exists:blocks,id',
        'soil_id' => 'required|exists:soils,id',
    ];

    /**
     * @return BelongsTo
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class,'block_id');
    }
    /**
     * @return BelongsTo
     */
    public function soil(): BelongsTo
    {
        return $this->belongsTo(Soil::class,'soil_id');
    }
}
