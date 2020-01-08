<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="SeedEvaluation",
 * )
 */
class SeedEvaluation extends BaseModel implements HasMedia
{

    use HasMediaTrait;

    public static $rules = [
        'seed_collection_id' => 'required|exists:seed_collections,id',
        'project.title' => 'required|string',
        'project.project_no' => 'required|string',
        'project.project_leader_name' => 'required|string',
        'project.research_leader_name' => 'required|string',
        'organization_id' => 'required|exists:organizations,id',
        'specimen_type_id'=>'required|exists:seed_generals,id',
        'collection_id'=>'required|exists:seed_generals,id',
    ];
    public static $germinations = [
        'germinations' => 'nullable|array',
        'dormancy_breaking_id'=>'required|exists:seed_generals,id',
        'dormancy_termination'=>'nullable|integer',
        'germination_period'=>'nullable|integer'
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


    public function research()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 3);
    }

    public function seedCollection()
    {
        return $this->belongsTo(SeedCollection::class);
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

    public function germinations()
    {
        return $this->hasMany(GerminationNumber::class);
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
}
