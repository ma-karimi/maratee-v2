<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Block",
 *            required={"station_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="station_id", type="integer"),
 * 			@SWG\Property(property="number", type="string")
 *        )
 */
class Block extends BaseModel
{
    public static $rules = [
        'number' => 'string',
        'station_id' => 'required|exists:stations,id',
    ];

    /**
     * @return BelongsTo
     */
    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class,'station_id');
    }
}
