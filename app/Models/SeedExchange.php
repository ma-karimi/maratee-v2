<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="SeedExchange",
 *      required={"organization_id","recipient_name","recipient_phone","request_no"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="organization_id",
 *          description="organization_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="department_id",
 *          description="department_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="project_id",
 *          description="project_id",
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
 *          property="accession_code",
 *          description="accession_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="regeneration_and_evaluation_code",
 *          description="regeneration_and_evaluation_code",
 *          type="string"
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
        'organization_id' => 'required|exists:organizations,id',
        'project_id' => 'exists:projects,id',
        'department_id' => 'exists:departments,id',
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
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    /**
     * @return BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @return BelongsTo
     */
    public function specimenTypeCollect()
    {
        return $this->belongsTo('App\Models\SeedGeneral');
    }

}
