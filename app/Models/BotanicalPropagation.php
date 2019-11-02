<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *            definition="BotanicalPropagation",
 *            required={"botanical_id", "propagation_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="botanical_id", type="integer"),
 * 			@SWG\Property(property="propagation_method_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class BotanicalPropagation extends BaseModel
{

    public const METHOD = [1 => 'seed', 2 => 'cutting', 3 => 'graft', 4 => 'natural', 5 => 'natural regeneration', 6 => 'root sucker', 7 => 'collar sprout'];

//    public static $rules = [
//        'botanical_id' => 'required|exists:botanicals,id',
//        'propagation_method_id' => 'required|integer'
//    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_propagations';

    protected $appends = ['propagation_method'];

    /**
     * @return BelongsTo
     */
    public function botanical(): BelongsTo
    {
        return $this->belongsTo(Botanical::class);
    }

    public function getPropagationMethodAttribute()
    {
        return !empty($this->attributes['propagation_method_id']) ? Arr::get(self::METHOD, $this->attributes['propagation_method_id']) : null;
    }

}
