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
 *      definition="SeedWeight",
 * )
 */
class SeedWeight extends BaseModel implements HasMedia, AuditableContract
{
    use HasMediaTrait, Auditable, AuditTrait;

    public static $rules = [
        'accession_code'=>'required|string',
//        'seed_collection_id' => 'required|exists:seed_collections,id',
        'collection_id' => 'required|exists:seed_generals,id',
        'thousand_fruits_weight' => 'nullable|numeric',
        'thousand_seeds_weight' => 'nullable|numeric',
        'total_fruit_weight' => 'nullable|numeric',
        'total_seed_weight' => 'nullable|numeric',
//        'collected_seeds_no' => 'required|numeric',
        'banked' => 'nullable|date'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_weights';

    protected $with = ['audits'];
    protected $appends = ['last_audit'];
    /**
     * @return BelongsTo
     */
    public function seedCollection()
    {
        return $this->belongsTo(SeedCollection::class, 'accession_code', 'accession_code');
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
        return $this->belongsTo(SeedGeneral::class, 'collection_id')->where('seed_generals.type_id', 28);
    }

    public function scopeByCollection($query, $collection_id)
    {
        return $query->where('collection_id', $collection_id);
    }

    public function scopeBySpecimenType($query, $specimen_type_id)
    {
        return $query->where('specimen_type_id', $specimen_type_id);
    }

    public function scopeBySeedCollection($query, $seed_collection_id)
    {
        return $query->where('seed_collection_id', $seed_collection_id);
    }
}
