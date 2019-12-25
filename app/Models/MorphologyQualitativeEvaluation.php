<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="MorphologyQualitativeEvaluation",
 *      required={"seed_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="collect_id",
 *          description="collect_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="taxonomy_id",
 *          description="taxonomy_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="station_id",
 *          description="station_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="replication_or_block_number",
 *          description="replication_or_block_number",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="voucher_no",
 *          description="voucher_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="observation",
 *          description="observation",
 *          type="string"
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
class MorphologyQualitativeEvaluation extends BaseModel
{

    public static $rules = [
        'seed_id' => 'required|exists:seeds,id',
        'collect_id' => 'required|exists:seed_generals,id',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'station_id' => 'required|exists:stations,id',
        'replication_or_block_number' => 'integer',
        'voucher_no' => 'string',
        'observation' => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo(Seed::class);
    }

    /**
     * @return BelongsTo
     */
    public function collect()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'collect_id');
    }

    /**
     * @return BelongsTo
     */
    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }

    /**
     * @return BelongsTo
     */
    public function taxonomy()
    {
        return $this->belongsTo('App\Models\Taxonomy');
    }

    /**
     * @return HasMany
     */
    public function vars()
    {
        return $this->hasMany('App\Models\MorphologyQualitativeEvaluationVar', 'evaluation_id');
    }
}
