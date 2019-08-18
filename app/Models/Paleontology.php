<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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
 *          property="geology_age_id",
 *          description="geology_age_id",
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
 *          property="access",
 *          description="access",
 *          type="array",
 *     @SWG\Items(type="string")
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
 *          property="collection_name",
 *          description="collection_name",
 *          type="array",
 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="location_no",
 *          description="location_no",
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
class Paleontology extends BaseModel
{
    public static $linguistically = ['infra_specific' => false, 'type_status' => false, 'preservation' => false, 'color' => false, 'element' => false, 'description' => true, 'additional_info' => false, 'access' => false, 'excavation' => false, 'collection_name' => false, 'common_name' => false];
    public static $rules = [
        'catalog_no' => 'integer',
        'specimen_no' => 'string',
        'field_no' => 'string',
        'barcode_no' => 'string',
        'move_status' => 'string',
        'salon' => 'string',
        'update_frequency' => 'string',
        'closet' => 'integer',
        'drawer' => 'integer',
        'pieces' => 'integer',
        'geology_age_id' => 'required|integer',
        'plant_id' => 'required|integer',
        'last_update' => 'date',
        'location_no' => 'integer',
        'general_class_id' => 'integer',
        'general_order_id' => 'integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded=['id'];


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
        'treatment' => 'json',
        'additional_info' => 'json',
        'access' => 'json',
        'excavation' => 'json',
        'collection_name' => 'json',
        'common_name' => 'json',
        'description' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'last_update', 'updated_at'];

    /**
     * @return HasMany
     */
    public function exchanges(): HasMany
    {
        return $this->hasMany(Exchange::class, ['send_paleontology_id', 'receive_paleontology_id'])->latest();
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
        return $this->belongsTo(General::class,'general_class_id');
    }
    /**
     * @return BelongsTo
     */
    public function generalOrder(): BelongsTo
    {
        return $this->belongsTo(General::class,'general_order_id');
    }

    /**
     * @return HasMany
     */
    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class)->latest();
    }

    /**
     * @return MorphToMany
     */
    public function treatments(): MorphToMany
    {
        return $this->morphToMany(TreatmentHub::class, 'treamentable');
    }

    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    public function borrows(): MorphMany
    {
        return $this->morphMany(Borrow::class, 'borrowable');
    }


    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphToMany(ArticleHub::class, 'articleable');
    }

    /**
     * @return MorphToMany
     */
    public function actions(): MorphToMany
    {
        return $this->morphToMany(ActionHub::class, 'actionable');
    }

}
