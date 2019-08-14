<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\SeedFeature;

/**
 * @SWG\Definition(
 *      definition="BioMolecular",
 *      required={"treatment","repeat","value","technology_id","seed_feature_id"},
 *      @SWG\Property(
 *          property="technology_id",
 *          description="technology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="block_id",
 *          description="block_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_feature_id",
 *          description="seed_feature_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="treatment",
 *          description="treatment",
 *          type="string",
 *     ),
 *      @SWG\Property(
 *          property="repeat",
 *          description="repeat",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
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

class BioMolecular extends BaseModel
{

    public static $rules=[
        'technology_id' => 'required|exists:technologies,id',
        'seed_feature_id' => 'required|exists:seed_features,id',
        'block_id' => 'exists:blocks,id',
        'treatment' => 'required|string',
        'repeat' => 'required|integer',
        'value' => 'required|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bio_moleculars';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded=['id'];


    /**
     * @return BelongsTo
     */
    public function technology()
    {
        return $this->belongsTo('App\Models\Technology');
    }
    /**
     * @return BelongsTo
     */
    public function seedFeature()
    {
        return $this->belongsTo(SeedFeature::class);
    }
    /**
     * @return BelongsTo
     */
    public function block()
    {
        return $this->belongsTo(Block::class);
    }

}
