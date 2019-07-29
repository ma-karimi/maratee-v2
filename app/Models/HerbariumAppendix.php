<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @SWG\Definition(
 *      definition="HerbariumAppendix",
 *      required={"herbarium_id","appendix","destination_herbarium_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="herbarium_id",
 *          description="herbarium_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="appendix",
 *          description="appendix",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="destination_herbarium_id",
 *          description="destination_herbarium_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class HerbariumAppendix extends BaseModel
{

    public static $rules=[
        'herbarium_id' => 'required|exists:herbariums,id',
        'destination_herbarium_id' => 'required|integer',
        'appendix' => 'required|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'herbarium_appendixes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['appendix', 'created_at', 'deleted_at', 'destination_herbarium_id', 'herbarium_id', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * @return BelongsTo
     */
    public function destinationHerbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class, 'destination_herbarium_id');
    }

    /**
     * @return BelongsTo
     */
    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
    }

}
