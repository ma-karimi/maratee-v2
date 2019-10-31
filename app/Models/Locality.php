<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="Locality",
 *      required={"paleontology_id","location_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="paleontology_id",
 *          description="paleontology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="formation",
 *          description="formation",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="layer",
 *          description="layer",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="stratigraphy",
 *          description="stratigraphy",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="lithology",
 *          description="lithology",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="fauna",
 *          description="fauna",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="map_id",
 *          description="map_id",
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
class Locality extends BaseModel
{
    public static $rules = [
        'paleontology_id' => 'required|exists:paleontologies,id',
        'location_id' => 'required|exists:locations,id',
        'formation' => 'string',
        'layer' => 'string',
        'stratigraphy' => 'string',
        'fauna' => 'string',
        'description' => 'string',
        'lithology' => 'string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'localities';

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
