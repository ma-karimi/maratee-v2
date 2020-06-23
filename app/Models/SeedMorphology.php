<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Scope\AuditScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="SeedMorphology",
 *      required={"collection_id"},
 * )
 */
class SeedMorphology extends BaseModel implements HasMedia, AuditableContract
{
    use HasMediaTrait, Auditable, AuditTrait;

    public static $rules = [
        'accession_code' => 'required|string',
        'collection_id' => 'required|exists:seed_generals,id',
        'specimen_type_id' => 'nullable|exists:seed_generals,id',
    ];

    protected $with = ['audits'];
    protected $appends = ['last_audit'];


    public function quantitatives(): BelongsToMany
    {
        return $this->belongsToMany(SeedGeneral::class, 'morphology_variables', 'seed_morphology_id')->withPivot('value')->whereNull('morphology_variables.deleted_at')->where('seed_generals.type_id', 26)->withTimestamps();
    }

    public function qualititatives(): BelongsToMany
    {
        return $this->belongsToMany(SeedGeneral::class, 'morphology_variables', 'seed_morphology_id')->withPivot('value')->whereNull('morphology_variables.deleted_at')->where('seed_generals.type_id', 27)->withTimestamps();
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(SeedMorphologyField::class, 'field_id');
    }


    /**
     * @return BelongsTo
     */
    public function seedCollection(): BelongsTo
    {
        return $this->belongsTo(SeedCollection::class);
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
