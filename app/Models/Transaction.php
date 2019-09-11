<?php

namespace App\Models;

use App\Models\Accessor\TransactionAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="Transaction",
 *      required={"user_id","organization_id","start_time","type_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer"
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
 *          property="start_time",
 *          description="start_time",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="end_time",
 *          description="end_time",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="type_id",
 *          description="'1: visit, 2: borrow, 3: exchange, 4:gift, 5:fair 6:expense 7:correspondence'",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="archive_no",
 *          description="archive_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="purpose",
 *          description="purpose",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="visit",
 *          description="1: Sample, 2: All/Museum",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="peoples_no",
 *          description="peoples_no",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="person_position",
 *          description="person_position",
 *         type="array",
 *          @SWG\Items(type="string"),
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
class Transaction extends BaseModel
{
    use TransactionAccessor;

    public const TYPE = [1 => 'visit', 2 => 'borrow', 3 => 'exchange', 4 => 'gift', 5 => 'fair', 6 => 'expense', 7 => 'correspondence'];
    public const VISIT = [1 => 'Sample', 2 => 'All/Museum'];
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'organization_id' => 'required|exists:organizations,id',
        'department_id' => 'exists:departments,id',
        'start_time' => 'required|date',
        'end_time' => 'date',
        'dead_line' => 'date',
        'type_id' => 'required|in:1,2,3,4,5,6,7',
        'archive_no' => 'string',
        'visit' => 'in:1,2',
        'peoples_no' => 'integer',
    ];
    public static $linguistically = [
        'description' => false,
        'purpose' => false,
        'person_position' => false,
    ];
    protected $casts = [
        'description' => 'json',
        'purpose' => 'json',
        'person_position' => 'json',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function paleontologies()
    {
        return $this->morphedByMany(Paleontology::class, 'transactionable')
            ->withTimestamps()
            ->withPivot(['type_id', 'sheets_no']);
    }

    public function herbariums()
    {
        return $this->morphedByMany(Herbarium::class, 'transactionable')
            ->withTimestamps()
            ->withPivot(['type_id', 'sheets_no']);
    }

    public function seeds()
    {
        return $this->morphedByMany(Seed::class, 'transactionable')
            ->withTimestamps()
            ->withPivot(['type_id', 'sheets_no']);
    }

    public function medicinalPlants()
    {
        return $this->morphedByMany(MedicinalPlant::class, 'transactionable')
            ->withTimestamps()
            ->withPivot(['type_id', 'sheets_no']);
    }
}
