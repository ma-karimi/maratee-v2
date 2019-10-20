<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="SeedExchange",
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
 *          property="seed_weight",
 *          description="seed_weight",
 *          type="number",
 *      ),
 *      @SWG\Property(
 *          property="delivery_date",
 *          description="delivery_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="recipient_name",
 *          description="recipient_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="recipient_phone",
 *          description="recipient_phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="request_no",
 *          description="request_no",
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
class SeedExchange extends BaseModel
{
    public static $linguistically = ['description' => true];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_exchanges';


    public static $rules = [
        'seed_id' => 'required|exists:seeds,id',
        'specimen_type_collect_id' => 'exists:seed_generals,id',
        'seed_weight' => 'numeric',
        'delivery_date' => 'date',
        'accession_code' => 'string',
        'regeneration_and_evaluation_code' => 'string',
        'recipient_name' => 'string',
        'recipient_phone' => 'string',
        'request_no' => 'string',
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
        return $this->belongsTo('App\Models\SeedGeneral');
    }

}
