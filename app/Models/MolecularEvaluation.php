<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="MolecularEvaluation",
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
 *          property="specimen_type_collect_id",
 *          description="specimen_type_collect_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="treat",
 *          description="treat",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="repeat",
 *          description="repeat",
 *          type="integer"
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
class MolecularEvaluation extends BaseModel
{

    public static $rules = [
        'seed_id' => 'required|exists:seeds,id',
        'specimen_type_collect_id' => 'exists:seed_generals,id',
        'treat' => 'string',
        'repeat' => 'integer'
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
    public function specimenTypeCollect()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'specimen_type_collect_id');
    }

    /**
     * @return HasMany
     */
    public function vars()
    {
        return $this->hasMany('App\Models\MolecularEvaluationVar');
    }
}
