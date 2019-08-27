<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="Taxonomy",
 *      required={"family_id","plant_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plant_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="genus_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="species_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="subspecies_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="variety_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="family_id",
 *          description="id",
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
class Taxonomy extends BaseModel
{


    public static $rules = [
        'family_id' => 'required|exists:generals,id',
        'plant_id' => 'required|exists:plants,id',
        'genus_id' => 'exists:generals,id',
        'species_id' => 'exists:generals,id',
        'variety_id' => 'exists:generals,id',
        'subspecies_id' => 'exists:generals,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'taxonomies';

    protected $dates = ['deleted_at'];
    protected $casts = ['type_description'=>'json'];


    /**
     * @return BelongsTo
     */
    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class, 'plant_id');
    }

    /**
     * @return BelongsTo
     */
    public function genus(): BelongsTo
    {
        return $this->belongsTo(General::class, 'genus_id')->where('type','genus');
    }

    /**
     * @return BelongsTo
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(General::class, 'species_id')->where('type','species');
    }

    /**
     * @return BelongsTo
     */
    public function subspecies(): BelongsTo
    {
        return $this->belongsTo(General::class, 'subspecies_id')->where('type','sub_species');
    }

    /**
     * @return BelongsTo
     */
    public function variety(): BelongsTo
    {
        return $this->belongsTo(General::class, 'variety_id')->where('type','variety');
    }

    /**
     * @return BelongsTo
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(General::class, 'family_id')->where('type','family');
    }


}
