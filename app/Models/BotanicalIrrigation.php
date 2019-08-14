<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="BotanicalIrrigation",
 *            required={"botanical_id", "irrigation_id", "daytime"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="botanical_id", type="integer"),
 * 			@SWG\Property(property="irrigation_id", type="integer"),
 * 			@SWG\Property(property="irrigation_time", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="requirement", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="seasonal_feature", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/

class BotanicalIrrigation extends BaseModel
{

    public static $linguistically=['irrigation_time'=>true,'requirement'=>false];
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
    protected $fillable = ['botanical_id', 'created_at', 'irrigation_time', 'deleted_at', 'irrigation_id', 'requirement', 'seasonal_feature', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['requirement' => 'json', 'irrigation_time' => 'json', 'seasonal_feature' => 'json'];


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
