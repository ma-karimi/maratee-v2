<?php

namespace App\Models;

use App\Models\Accessor\PaleontologyAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ActionRelation;
use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Paleontology",
 *      required={"taxonomy_id","catalog_no"}
 * )
 */
class Paleontology extends BaseModel implements HasMedia
{
    use PaleontologyAccessor, ActionRelation, ArticleRelation,HasMediaTrait;
    public static $rules = [
        'catalog_no' => 'integer',
        'specimen_no' => 'string',
        'infra_specific' => 'string',
        'preservation' => 'string',
        'color' => 'string',
        'element' => 'string',
        'additional_info' => 'string',
        'excavation' => 'string',
        'access_code' => 'string',
        'field_no' => 'string',
        'barcode_no' => 'string',
        'move_status' => 'string',
        'salon' => 'string',
        'update_frequency' => 'string',
        'closet' => 'integer',
        'drawer' => 'integer',
        'pieces' => 'integer',
        'geology_age_era_id' => 'integer|exists:geology_ages,id',
        'geology_age_epoch_id' => 'integer|exists:geology_ages,id',
        'geology_age_stage_id' => 'integer|exists:geology_ages,id',
        'geology_age_period_id' => 'integer|exists:geology_ages,id',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'last_update' => 'date',
        'location_id' => 'required|exists:locations,id',
        'general_order_id' => 'integer|exists:generals,id',
        'general_plant_type_id' => 'integer|exists:generals,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontologies';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function geologyAgePeriod(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class)->where('type', 'period');
    }
    /**
     * @return BelongsTo
     */
    public function geologyAgeStage(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class)->where('type','stage');
    }
    /**
     * @return BelongsTo
     */
    public function geologyAgeEpoch(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class)->where('type','epoch');
    }
    /**
     * @return BelongsTo
     */
    public function geologyAgeEra(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class)->where('type','era');
    }
    /**
     * @return BelongsTo
     */
    public function geologyAge(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class);
    }

    public function determine()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 1);
    }

    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }


    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }

    /**
     * @return BelongsTo
     */
    public function generalClass(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_class_id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function generalOrder(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_order_id');
    }

    /**
     * @return HasOne
     */
    public function locality(): HasOne
    {
        return $this->hasOne(Locality::class);
    }


    /**
     * @return MorphToMany
     */
    public function treatments(): MorphToMany
    {
        return $this->morphToMany(TreatmentHub::class, 'treamentable');
    }

    /**
     * @return MorphToMany
     */
    public function transactions(): MorphToMany
    {
        return $this->morphToMany(Transaction::class, 'transactionable', 'transaction_hubs')
            ->withTimestamps()
            ->withPivot(['type_id', 'sheets_no']);
    }

    public function maps(): BelongsToMany
    {
        return $this->belongsToMany(Map::class,
            'paleontology_maps',
            'paleontology_id',
            'map_id');
    }
}
