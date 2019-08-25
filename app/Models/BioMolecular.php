<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\SeedFeature;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Technology;

/**
 * @SWG\Definition(
 *      definition="BioMolecular",
 *      required={"repeat","value","technology_id","seed_feature_id"},
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

    public static $rules = [
        'technology_id' => 'required|exists:technologies,id',
        'seed_feature_id' => 'required|exists:seed_features,id',
        'block_id' => 'exists:blocks,id',
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
     * @return BelongsTo
     */
    public function technology()
    {
        return $this->belongsTo(Technology::class);
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


    /**
     * @return MorphToMany
     */
    public function treatments(): MorphToMany
    {
        return $this->morphToMany(Treatment::class, 'treatmentable', 'treatment_hubs')
            ->whereNull('treatment_hubs.deleted_at')
            ->withTimestamps();
    }
}
