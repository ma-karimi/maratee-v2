<?php

namespace App\Models;

use App\Models\Accessor\PaleontologyAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ActionRelation;
use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
    use PaleontologyAccessor, ActionRelation, ArticleRelation, HasMediaTrait;
    public static $rules = [


        'update_frequency' => 'nullable|string',
        'location_in_collection' => 'nullable|integer',
        'pieces' => 'nullable|integer',
        'geology_age_era_id' => 'nullable|integer|exists:geology_ages,id',
        'geology_age_epoch_id' => 'nullable|integer|exists:geology_ages,id',
        'geology_age_stage_id' => 'nullable|integer|exists:geology_ages,id',
        'geology_age_period_id' => 'nullable|integer|exists:geology_ages,id',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'last_update' => 'nullable|date',
        'general_order_id' => 'nullable|integer|exists:generals,id',
        'general_plant_type_id' => 'nullable|integer|exists:generals,id',
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

    protected $appends = ['samples', 'fair', 'gift', 'buy', 'borrow', 'visit'];

    /**
     * @return BelongsTo
     */
    public function geologyAgePeriod(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class)->ofType(2);
    }

    /**
     * @return BelongsTo
     */
    public function geologyAgeStage(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class)->ofType(4);
    }

    /**
     * @return BelongsTo
     */
    public function geologyAgeEpoch(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class)->ofType(3);
    }

    /**
     * @return BelongsTo
     */
    public function geologyAgeEra(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class)->ofType(1);
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
        return $this->belongsTo(General::class, 'general_class_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalOrder(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_order_id');
    }

    public function generalSamples()
    {
        return $this->belongsToMany(General::class, 'paleontology_samples', 'id', 'sample_id')->whereType('sample');
    }

    /**
     * @return BelongsTo
     */
    public function generalPlantType(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_plant_type_id')->whereType('plant_type');
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

    public function maps(): HasMany
    {
        return $this->hasMany(PaleontologyMap::class)->latest();
    }

    public function citations(): HasMany
    {
        return $this->hasMany(PaleontologyCitation::class)->latest();
    }

    public function getVisitAttribute()
    {
        return $this->transactions()
            ->where('type_id', array_search('visit', Transaction::TYPE))
            ->first();
    }

    /**
     * @return MorphMany
     */
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable')
            ->latest()
            ->whereNull('deleted_at');
    }

    public function getBorrowAttribute()
    {
        return $this->transactions()->where('type_id', array_search('borrow', Transaction::TYPE))->first();
    }

    public function getFairAttribute()
    {
        return $this->transactions()->where('type_id', array_search('fair', Transaction::TYPE))->first();
    }

    public function getGiftAttribute()
    {
        return $this->transactions()->where('type_id', array_search('gift', Transaction::TYPE))->first();
    }

    public function getBuyAttribute()
    {
        return $this->transactions()->where('type_id', array_search('buy', Transaction::TYPE))->first();
    }
}
