<?php

namespace App\Models;

use App\Models\Accessor\PaleontologyAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ActionRelation;
use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Paleontology",
 *      required={"geology_age_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_class_id",
 *          description="general_class_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="general_order_id",
 *          description="general_order_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="catalog_no",
 *          description="catalog_no",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="specimen_no",
 *          description="specimen_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="field_no",
 *          description="field_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="barcode_no",
 *          description="barcode_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="move_status",
 *          description="move_status",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="salon",
 *          description="salon",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="closet",
 *          description="closet",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="drawer",
 *          description="drawer",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="infraspecific",
 *          description="infraspecific",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="type_status",
 *          description="type_status",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="preservation",
 *          description="preservation",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="pieces",
 *          description="pieces",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="color",
 *          description="color",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="element",
 *          description="element",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="geology_age_era_id",
 *          description="geology_age_era_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="geology_age_epoch_id",
 *          description="geology_age_epoch_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="geology_age_stage_id",
 *          description="geology_age_stage_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="geology_age_period_id",
 *          description="geology_age_period_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="additional_info",
 *          description="additional_info",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="access_code",
 *          description="access_code",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="last_update",
 *          description="last_update",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="excavation",
 *          description="excavation",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="collector_name",
 *          description="collector_name",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="update_frequency",
 *          description="update_frequency",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="common_name",
 *          description="common_name",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="plant_id",
 *          description="plant_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Paleontology extends BaseModel implements HasMedia
{
    use PaleontologyAccessor, ActionRelation, ArticleRelation,HasMediaTrait;
    public static $linguistically = ['infra_specific' => false, 'type_status' => false, 'preservation' => false, 'color' => false, 'element' => false, 'description' => true, 'additional_info' => false, 'excavation' => false, 'collector_name' => false, 'common_name' => false];
    public static $rules = [
        'catalog_no' => 'integer',
        'specimen_no' => 'string',
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
        'plant_id' => 'required|exists:plants,id',
        'last_update' => 'date',
        'location_id' => 'integer|exists:locations,id',
        'general_order_id' => 'integer|exists:generals,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontologies';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'infra_specific' => 'json',
        'type_status' => 'json',
        'preservation' => 'json',
        'color' => 'json',
        'element' => 'json',
        'treatment_history' => 'json',
        'additional_info' => 'json',
        'excavation' => 'json',
        'collector_name' => 'json',
        'common_name' => 'json',
        'description' => 'json',
    ];

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

    /**
     * @return BelongsTo
     */
    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class);
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
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return HasMany
     */
    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class)->latest();
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
