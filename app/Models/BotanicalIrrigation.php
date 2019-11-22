<?php

namespace App\Models;

use App\Models\Accessor\BotanicalIrrigationAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="BotanicalIrrigation",
 *            required={"botanical_id", "irrigation_id", "requirement_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="botanical_id", type="integer"),
 * 			@SWG\Property(property="irrigation_id", type="integer"),
 * 			@SWG\Property(property="requirement", type="integer"),
 * 			@SWG\Property(property="irrigation_time_id", type="integer"),
 * 			@SWG\Property(property="spring_time", type="string"),
 * 			@SWG\Property(property="autumn_time", type="string"),
 * 			@SWG\Property(property="summer_time", type="string"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class BotanicalIrrigation extends BaseModel
{
    use BotanicalIrrigationAccessor;
    public const REQUIREMENT = [1 => 'sparse', 2 => 'moderate', 3 => 'heavy'];
    public const IRRIGATION_TIME = [1 => 'indifferent', 2 => 'morning', 3 => 'day', 4 => 'evening', 5 => 'night'];
    public const IRRIGATIONS= [1 => 'mist', 2 => 'sprinkler', 3 => 'drip', 4 => 'manual', 5 => 'pot watering', 6=>'none'];
    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'irrigation_id' => 'required|in:1,2,3,4,5,6',
        'requirement_id' => 'required|in:1,2,3',
        'irrigation_time_id' => 'required|in:1,2,3,4,5',
        'spring_time' =>'string',
        'autumn_time' =>'string',
        'summer_time' =>'string',
    ];

    protected $appends = ['requirement', 'irrigation_time', 'irrigation'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_irrigations';


    /**
     * @return BelongsTo
     */
    public function botanical(): BelongsTo
    {
        return $this->belongsTo(Botanical::class);
    }

}
