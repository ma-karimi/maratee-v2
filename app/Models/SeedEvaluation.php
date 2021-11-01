<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
/**
 * @SWG\Definition(
 *      definition="SeedEvaluation",
 * )
 */
class SeedEvaluation extends BaseModel implements HasMedia, AuditableContract
{

    use InteractsWithMedia, Auditable, AuditTrait;


    public static $rules = [
        'accession_code' => 'required|string',
        'project_title' => 'nullable|string',
        'project_no' => 'nullable|string',
        'project_leader_name' => 'nullable|string',
        'research_leader_name' => 'nullable|string',
//        'organization_id' => 'required|exists:organizations,id',
//        'specimen_type_id' => 'required|exists:seed_generals,id',
        'collection_id' => 'required|exists:seed_generals,id',
    ];
    public static $germinations = [
        'germinations' => 'nullable|array',
        'dormancy_breaking_id' => 'nullable|exists:seed_generals,id',
        'dormancy_termination' => 'nullable|integer',
        'germination_period' => 'nullable|integer',
    ];
    public static $lengths = [
        'shoots' => 'nullable|array',
        'lengths' => 'nullable|array',
        'radicals' => 'nullable|array',
        'widths' => 'nullable|array',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_evaluations';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];
    protected $appends = ['viability', 'germination', 'last_audit'];
    protected $with = ['audits'];

    public function research()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 3);
    }

    public function seedCollection()
    {
        return $this->belongsTo(SeedCollection::class, 'accession_code', 'accession_code');
    }

    public function radicals()
    {
        return $this->hasMany(SeedLength::class)->where('type_id', 1);
    }

    public function shoots()
    {
        return $this->hasMany(SeedLength::class)->where('type_id', 2);
    }

    public function lengths()
    {
        return $this->hasMany(SeedLength::class)->where('type_id', 3);
    }

    public function widths()
    {
        return $this->hasMany(SeedLength::class)->where('type_id', 4);
    }

    public function dormancyBreaking()
    {
        return $this->belongsTo(SeedGeneral::class, 'dormancy_breaking_id')->where('type_id', 23);
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

    public function getViabilityAttribute()
    {
        $germinated_seed = $this->germinated_seed_no ?? 0;
        $fresh_non_germinated = $this->fresh_non_germinated ?? 0;
        $abnormal = $this->abnormal ?? 0;

        $f = $this->planted_seeds == 0 ? 0 : (($germinated_seed + $fresh_non_germinated + $abnormal) / $this->planted_seeds) * 100;
        return round($f, 3);
    }

    public function getGerminationAttribute()
    {
        $germinated_seed = $this->germinated_seed_no ?? 0;
        $planted_seeds = $this->planted_seeds ?? 0;

        $f = $germinated_seed == 0 || $planted_seeds == 0 ? 0 : ($germinated_seed / $planted_seeds) * 100;
        return round($f, 3);
    }
//
//    public function getGerminatedSeedNoAttribute()
//    {
//        if ($this->relationLoaded('germinations') && count($this->germinations)) {
//            return $this->germinations()->latest()->first()->germinated_number;
//        }
//    }
//
//    public function germinations()
//    {
//        return $this->hasMany(GerminationNumber::class);
//    }
}
