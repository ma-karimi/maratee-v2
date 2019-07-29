<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="Geramin",
 *      required={"collection_id","seed_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="collection_id",
 *          description="collection_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="repeat",
 *          description="repeat",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="bush",
 *          description="bush",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="average",
 *          description="average",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="flowering_completion",
 *          description="flowering_completion",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="gdd_flowering",
 *          description="gdd_flowering",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="essence_rate",
 *          description="essence_rate",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="bush_weight",
 *          description="bush_weight",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="bush_height",
 *          description="bush_height",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="big_bush_diameter",
 *          description="big_bush_diameter",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="small_bush_diameter",
 *          description="small_bush_diameter",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="flowering_bish_qt",
 *          description="flowering_bish_qt",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="crown_coverage",
 *          description="crown_coverage",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="flower_color",
 *          description="flower_color",
 *          type="array",
 *     @SWG\Items(type="string"),
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
class Geramin extends BaseModel
{

    public static $rules=[
        'collection_id' => 'required|exists:collections,id',
        'seed_id' => 'required|exists:seeds,id',
        'repeat' => 'string',
        'bush' => 'integer',
        'average' => 'integer',
        'flowering_completion' => 'date',
        'gdd_flowering' => 'date',
        'essence_rate' => 'integer',
        'bush_weight' => 'integer',
        'bush_height' => 'integer',
        'big_bush_diameter' => 'integer',
        'small_bush_diameter' => 'integer',
        'flowering_bish_qt' => 'integer',
        'crown_coverage' => 'integer'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geramins';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['average', 'big_bush_diameter', 'bush', 'bush_height', 'bush_weight', 'collection_id', 'created_at', 'crown_coverage', 'deleted_at', 'essence_rate', 'flower_color', 'flowering_bish_qt', 'flowering_completion', 'gdd_flowering', 'repeat', 'seed_id', 'small_bush_diameter', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['flower_color' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'flowering_completion', 'gdd_flowering', 'updated_at'];


    /**
     * @return BelongsTo
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * @return BelongsTo
     */
    public function seed(): BelongsTo
    {
        return $this->belongsTo(Seed::class);
    }
}
