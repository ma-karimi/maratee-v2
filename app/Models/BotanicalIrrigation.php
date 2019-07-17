<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            name="BotanicalIrrigation",
 *            required={"botanical_id", "irrigation_id", "daytime"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="botanical_id", type="integer"),
 * 			@SWG\Property(name="irrigation_id", type="integer"),
 * 			@SWG\Property(name="daytime", type="array"),
 * 			@SWG\Property(name="requirement", type="array"),
 * 			@SWG\Property(name="seasonal_feature", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/

class BotanicalIrrigation extends BaseModel
{


    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'irrigation_id' => 'required|exists:irrigations,id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_irrigations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'daytime', 'deleted_at', 'irrigation_id', 'requirement', 'seasonal_feature', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['requirement' => 'json', 'daytime' => 'json', 'seasonal_feature' => 'json'];


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
