<?php

namespace App\Models;

use App\Models\Accessor\MediaAccessor;
use App\Models\Relations\ArticleRelation;
use App\Models\Relations\BaseModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

/**
 * @SWG\Definition(
 *      definition="Media",
 *      required={"name","format_type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array",
 *     @SWG\Items(type="string"),
 *      ),
 *      @SWG\Property(
 *          property="format_type",
 *          description="format_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="herbarium_id",
 *          description="herbarium_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="paleontology_id",
 *          description="paleontology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="media_type",
 *          description="media_type",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="reference",
 *          description="reference",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="medicinal_plant_id",
 *          description="medicinal_plant_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_id",
 *          description="product_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="botanical_id",
 *          description="botanical_id",
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
class Media extends BaseMedia
{
    //use BaseModelTrait instead of BaseModel Class
    use BaseModelTrait,MediaAccessor, ArticleRelation;

    public static $jsons = [];
    public static $messages = [];
    protected $appends=['full_url'];

    public const MEDIA_TYPE = [1 => 'sketch', 2 => 'picture'];
    public static $linguistically = ['description' => false, 'reference' => false];


    public static $rules = [
        'format_type' => 'required|string',
        'media_type' => 'required|integer|in:1,2',
        'date' => 'date',
        'user_id' => 'exists:users,id',
        'location_id' => 'exists:locations,id',
        'herbarium_id' => 'exists:herbariums,id',
        'seed_id' => 'exists:seeds,id',
        'paleontology_id' => 'exists:paleontologies,id',
        'medicinal_plant_id' => 'exists:medicinal_plants,id',
        'product_id' => 'exists:products,id',
        'botanical_id' => 'exists:botanicals,id'
    ];
    protected $casts=[
        'reference'=>'json',
        'description'=>'json',
        'manipulations'=>'array',
        'responsive_images'=>'array',
        'custom_properties'=>'array',
    ];
    protected $dates=['date'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medias';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    //protected $casts = ['name' => 'json', 'reference' => 'json', 'description' => 'json'];




    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphToMany(ArticleHub::class, 'articleable')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function botanical(): BelongsTo
    {
        return $this->belongsTo(Botanical::class);
    }

    /**
     * @return BelongsTo
     */
    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
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
    public function medicinalPlant(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlant::class);
    }

    /**
     * @return BelongsTo
     */
    public function paleontology(): BelongsTo
    {
        return $this->belongsTo(Paleontology::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function seed(): BelongsTo
    {
        return $this->belongsTo(Seed::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class)->latest();
    }


    /**
     * @return MorphToMany
     */
    public function locations(): MorphToMany
    {
        return $this->morphToMany(LocationHub::class, 'locationable')->withTimestamps();
    }


    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(UserHub::class, 'userable')->withTimestamps();
    }

}
