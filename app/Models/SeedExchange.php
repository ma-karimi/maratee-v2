<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="SeedExchange",
 *      required={"seed_collection_id"},
 * )
 */
class SeedExchange extends BaseModel implements HasMedia, AuditableContract
{
    use HasMediaTrait, Auditable, AuditTrait;
    public static $rules = [
        'seed_collection_id' => 'required|exists:seed_collections,id',
        'collection_id' => 'required|exists:seed_generals,id',
        'specimen_type_id' => 'required|exists:seed_generals,id',
        'weight' => 'required|numeric',
        'delivery_date' => 'required|date',
        'recipient_name' => 'required|string',
//        'recipient_phone' => 'required|string',
        'request_no' => 'required|string',
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
    public function seedCollection()
    {
        return $this->belongsTo(SeedCollection::class);
    }

    /**
     * @return BelongsTo
     */
    public function specimenType()
    {
        return $this->belongsTo(SeedGeneral::class, 'specimen_type_id')->where('seed_generals.type_id', 1);
    }

    /**
     * @return BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo(SeedGeneral::class, 'collection_id')->where('seed_generals.type_id', 19);
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
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
