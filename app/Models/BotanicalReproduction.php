<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            name="BotanicalReproduction",
 *            required={"botanical_id", "reproduction_id"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="botanical_id", type="integer"),
 * 			@SWG\Property(name="reproduction_id", type="integer"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class BotanicalReproduction extends BaseModel
{



    public static $rules = [
        'botanical_id' => 'required|exists:botanicals,id',
        'reproduction_id' => 'required|exists:reproductions,id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_reproductions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'deleted_at', 'reproduction_id', 'updated_at'];


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
    public function reproduction(): BelongsTo
    {
        return $this->belongsTo(Reproduction::class);
    }

}
