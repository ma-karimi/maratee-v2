<?php

namespace App\Models;

use App\Models\Accessor\BotanicalIrrigationAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="BotanicalIrrigation",
 *            required={"botanical_id", "irrigation_id", "requirement"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="botanical_id", type="integer"),
 * 			@SWG\Property(property="irrigation_id", type="integer"),
 * 			@SWG\Property(property="requirement", type="integer"),
 * 			@SWG\Property(property="appropriate_irrigation_time", type="integer"),
 * 			@SWG\Property(property="irrigation_time", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class BotanicalIrrigation extends BaseModel
{
    use BotanicalIrrigationAccessor;
    public const REQUIREMENT = [1 => 'sparse', 2 => 'moderate', 3 => 'heavy'];
    public const IRRIGATION_TIME = [0 => 'indifferent', 1 => 'morning', 2 => 'day', 3 => 'evening', 4 => 'night'];
    public static $linguistically = ['irrigation_time' => true, 'requirement' => false];
    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'irrigation_id' => 'required|exists:irrigations,id',
        'requirement' => 'required|in:1,2,3',
        'appropriate_irrigation_time' => 'required|in:0,1,2,3,4',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_irrigations';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['irrigation_time' => 'json'];


    /**
     * @return BelongsTo
     */
    public function botanical(): BelongsTo
    {
        return $this->belongsTo(Botanical::class);
    }

    /**
     * @return BelongsTo
     */
    public function irrigation(): BelongsTo
    {
        return $this->belongsTo(Irrigation::class);
    }

}
