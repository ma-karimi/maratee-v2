<?php

namespace App\Models;

use App\Models\Accessor\BotanicalOperationAccessor;
use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            definition="BotanicalOperation",
 *            required={"botanical_id", "location_id","operation_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="botanical_id", type="integer"),
 * 			@SWG\Property(property="location_id", type="integer"),
 * 			@SWG\Property(property="operation_id", type="integer"),
 * 			@SWG\Property(property="date", type="string"),
 * 			@SWG\Property(property="number", type="string"),
 * 			@SWG\Property(property="description", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class BotanicalOperation extends BaseModel
{
    use BotanicalOperationAccessor;
    public const OPERATION = [1 => 'seeding', 2 => 'planting'];
    public static $linguistically = ['description' => false];
    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'location_id' => 'required|exists:locations,id',
        'operation_id' => 'required|in:1,2',
        'number' => 'required|string',
        'date' => 'date',
    ];

    protected $casts=['description'=>'json'];

    public function botanical()
    {
        return $this->belongsTo(Botanical::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
