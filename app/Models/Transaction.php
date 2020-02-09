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
 *      required={"member_name","organization_id","start_time","type_id"}
 * )
 */
class Transaction extends BaseModel implements HasMedia
{
    public const MODE = [1 => 'send', 2 => 'receive'];
    use TransactionAccessor, HasMediaTrait;
    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];
    public const TYPE = [1 => 'visit', 2 => 'borrow', 3 => 'exchange', 4 => 'gift', 5 => 'fair', 6 => 'buy'];
    public const VISIT = [1 => 'Sample', 2 => 'All/Museum'];
    public static $rules = [
        'member_name' => 'nullable|string',
        'member_address' => 'nullable|string',
        'member_email' => 'nullable|string',
        'member_phone' => 'nullable|string',
        'organization_id' => 'nullable|exists:organizations,id',
        'department_name' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'nullable|date',
        'dead_line' => 'nullable|date',
        'type_id' => 'required|in:1,2,3,4,5,6,7',
        'archive_no' => 'nullable|string',
//        'visit_id' => 'required_if:type_id,1|in:1,2',
        'peoples_no' => 'nullable|integer',
        'description' => 'nullable|string',
        'purpose' => 'nullable|string',
        'person_position' => 'nullable|string',
        'mode_id' => 'required_if:type_id,3|in:1,2',
        'sheets_no' => 'nullable|string',
        'sample_impression_id' => 'nullable|numeric',
    ];
    protected $appends = ['type', 'visit', 'mode', 'sample_impression'];
    protected $with = ['organization', 'media'];

    /**p
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function transactionable()
    {
        return $this->morphTo();
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

    public function medicinalPlants()
    {
        return $this->morphedByMany(MedicinalPlant::class, 'transactionable')
            ->withTimestamps()
            ->withPivot(['type_id', 'sheets_no']);
    }
}
