<?php

namespace App\Models;

use App\Models\Accessor\PlantAccessor;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\{ActionRelation, ArticleRelation};
use App\Models\Scope\PlantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Plant",
 *      required={"location_id","organization_id","protection_id","general_phytogeography_id"}
 * )
 */
class Plant extends BaseModel implements HasMedia, AuditableContract
{
    use PlantScope, PlantAccessor, ActionRelation, ArticleRelation, HasMediaTrait, Auditable, AuditTrait;

    public const LIFE_FORM = [['id' => "1", 'name' => 'annual'], ['id' => "2", 'name' => 'perennial'], ['id' => "3", 'name' => 'tree'], ['id' => "4", 'name' => 'shrubs']];

    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];
    protected $with = ['audits'];
    protected $casts = ['life_forms' => 'json', 'phytogeographics' => 'json'];
    protected $appends = ['monopoly_of_iran', 'plant_geographicals', 'plant_phytogeographics', 'iran_plant_geographicals', 'iran_direction_geographicals', 'life_form', 'last_audit'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
    }
//
//    public function locations(): MorphToMany
//    {
//        return $this->morphToMany(Location::class, 'locationable', 'location_hubs')
//            ->whereNull('location_hubs.deleted_at')
//            ->withTimestamps();
//    }

    public function protection(): BelongsTo
    {
        return $this->belongsTo(Protection::class);
    }
//
//    public function generalPhytogeography(): BelongsTo
//    {
//        return $this->belongsTo(General::class, 'general_phytogeography_id');
//    }
    public function phytogeographic(): BelongsToMany
    {
        return $this->belongsToMany(General::class, 'plant_phytogeographics')
            ->whereNull('plant_phytogeographics.deleted_at')
            ->where('generals.type', 'phytogeography')
            ->withTimestamps();
    }

    public function geographicals(): BelongsToMany
    {
        return $this->belongsToMany(Geographical::class, 'plant_geographicals')
            ->whereNull('plant_geographicals.deleted_at')
            ->where('geographicals.type_id', 1)
            ->withTimestamps();
    }

    public function iranGeographicals(): BelongsToMany
    {
        return $this->belongsToMany(Geographical::class, 'plant_geographicals')
            ->where('geographicals.type_id', 2)
            ->whereNull('plant_geographicals.deleted_at')
            ->withTimestamps();
    }

    public function directionGeographicals(): BelongsToMany
    {
        return $this->belongsToMany(Geographical::class, 'plant_geographicals')
            ->where('geographicals.type_id', 3)
            ->whereNull('plant_geographicals.deleted_at')
            ->withTimestamps();
    }
}


