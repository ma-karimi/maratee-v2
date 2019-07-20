<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 *          property="typestatus",
 *          description="typestatus",
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
 *          property="treatment",
 *          description="treatment",
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
 *          property="common_name",
 *          description="common_name",
 *          type="array",
	 *     @SWG\Items(type="string")
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
    protected $fillable = ['access', 'additional_info', 'barcode_no', 'catalog_no', 'closet', 'collection_name', 'color', 'common_name', 'created_at', 'deleted_at', 'drawer', 'element', 'excavation', 'field_no', 'geology_age_id', 'infraspecific', 'last_update', 'location_no', 'move_status', 'pieces', 'preservation', 'salon', 'specimen_no', 'treatment', 'typestatus', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'infraspecific' => 'json',
        'typestatus' => 'json',
        'preservation' => 'json',
        'color' => 'json',
        'element' => 'json',
        'treatment' => 'json',
        'additional_info' => 'json',
        'access' => 'json',
        'excavation' => 'json',
        'collection_name' => 'json',
        'common_name' => 'json',
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
     * @return HasMany
     */
    public function paleontologyActions(): HasMany
    {
        return $this->hasMany(PaleontologyAction::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function paleontologyCitations(): HasMany
    {
        return $this->hasMany(PaleontologyCitation::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function paleontologyMedias(): HasMany
    {
        return $this->hasMany(PaleontologyMedia::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class)->latest();
    }
}
