<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @SWG\Definition(
 *      definition="SeedExchange",
 *      required={"seed_id","collection_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *          property="collection_id",
 *          description="collection_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="weight",
 *          description="weight",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="approval_no",
 *          description="approval_no",
 *          type="array"
 *      ),
 *      @SWG\Property(
 *          property="saved_type",
 *          description="saved_type",
 *          type="array"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array"
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
class SeedExchange extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_exchanges';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['approval_no', 'collection_id', 'created_at', 'date', 'deleted_at', 'description', 'saved_type', 'seed_id', 'type', 'updated_at', 'weight'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'approval_no' => 'json',
        'saved_type' => 'json',
        'description' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo('App\Models\Collection');
    }

    /**
     * @return BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo('App\Models\Seed');
    }

}
