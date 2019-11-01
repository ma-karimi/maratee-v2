<?php

namespace App\Models;

use App\Models\Accessor\TransactionAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Transaction",
 *      required={"user_id","organization_id","start_time","type_id"}
 * )
 */
class Transaction extends BaseModel implements HasMedia
{
    protected $appends=['type', 'visit'];
    use TransactionAccessor,HasMediaTrait;
    public const Mode = [1 => 'send', 2 => 'receive'];

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
        'visit_id' => 'required_if:type_id,1|in:1,2',
        'peoples_no' => 'integer',
        'description' => 'string',
        'purpose' => 'string',
        'person_position' => 'string',
        'mode_id' => 'required_if:type_id,3|in:1,2',
        'sheets_no' => 'string',
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
        return $this->morphedByMany(PlantHerbarium::class, 'transactionable')
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
