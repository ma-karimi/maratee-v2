<?php

namespace App\Models;

use App\Models\Accessor\CryoBankAccessor;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ActionRelation;
use App\Models\Relations\ArticleRelation;
use App\Models\Scope\CryoBankScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *            definition="CryoBank",
 *            required={"taxonomy_id", "protection_id"},
 *
 */
class CryoBank extends BaseModel implements HasMedia, AuditableContract
{
    use CryoBankScope, ActionRelation, ArticleRelation, CryoBankAccessor, HasMediaTrait, Auditable, AuditTrait;

    public const TYPE_SAMPLE = [
        1 => 'seed', 2 => 'shoot', 3 => 'cell'
    ];
    public const SAMPLE = [
        1 => 'S', 2 => 'SH', 3 => 'C'
    ];
    public static $rules = [
        'protection_id' => 'required|exists:protections,id',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'sample_type_id' => 'required|in:1,2,3',
        'box' => 'required|string',
        'repeat' => 'nullable|string',
        'tank' => 'required|string',
        'cell' => 'required|string',
        'rack' => 'required|string',
        'proposal_name' => 'nullable|string',
        'treatment_id' => 'nullable|exists:treatments,id',
        'treatment_values' => 'nullable|string',
        'year' => 'required|integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cryo_banks';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $appends = ['genotype_code', 'last_audit'];
    protected $with = ['audits', 'sampleType'];

    /**
     * @return BelongsTo
     */
    public function protection(): BelongsTo
    {
        return $this->belongsTo(Protection::class);
    }

    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function sampleType(): BelongsTo
    {
        return $this->belongsTo(CryobankGeneral::class, 'sample_type_id', 'id')->whereNull('cryobank_generals.deleted_at')
            ->where('cryobank_generals.type', 'sample');
    }

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }
}
