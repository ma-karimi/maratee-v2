<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="BotanicalPropagation",
 *            required={"botanical_id", "propagation_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="botanical_id", type="integer"),
 * 			@SWG\Property(property="propagation_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class BotanicalPropagation extends BaseModel
{

    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'propagation_id' => 'required|exists:propagations,id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_propagations';

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
    public function propagation(): BelongsTo
    {
        return $this->belongsTo(Propagation::class);
    }

}
