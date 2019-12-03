<?php

namespace App\Models;

use App\Models\Accessor\BotanicalOperationAccessor;
use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="BotanicalOperation",
 *            required={"botanical_id", "place_id","operation_id"},
 *
 */
class BotanicalOperation extends BaseModel
{
    use BotanicalOperationAccessor;
    public const OPERATION = [1 => 'seeding', 2 => 'planting', 3 => 'transfer'];
    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'place_id' => 'required|exists:places,id',
        'operation_id' => 'required|in:1,2,3',
        'number' => 'required|string',
        'date' => 'required|date',
        'description' => 'nullable|string'
    ];

    protected $with = ['place'];

    public function botanical()
    {
        return $this->belongsTo(Botanical::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}
