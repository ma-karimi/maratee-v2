<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
/**
 * @SWG\Definition(
 *      definition="SeedExchange",
 *      required={"seed_collection_id"},
 * )
 */
class SeedExchange extends BaseModel implements HasMedia, AuditableContract
{
    use InteractsWithMedia, Auditable, AuditTrait;

    public static $rules = [
        'accession_code' => 'required|string',
        'collection_id' => 'required|exists:seed_generals,id',
        'specimen_type_id' => 'nullable|exists:seed_generals,id',
        'weight' => 'nullable|numeric',
        'delivery_date' => 'nullable|date',
        'recipient_name' => 'nullable|string',
//        'recipient_phone' => 'required|string',
        'request_no' => 'nullable|string',
    ];
    protected $appends = ['last_audit'];
    protected $with = ['audits'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_exchanges';

    /**
     * @return BelongsTo
     */
    public function seedCollection(): BelongsTo
    {
        return $this->belongsTo(SeedCollection::class, 'accession_code', 'accession_code');
    }

    /**
     * @return BelongsTo
     */
    public function specimenType(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'specimen_type_id')->where('seed_generals.type_id', 1);
    }

    /**
     * @return BelongsTo
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'collection_id')->where('seed_generals.type_id', 28);
    }

    /**
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
