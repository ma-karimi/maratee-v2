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
    use BaseModelTrait, MediaAccessor, ArticleRelation;

    public const MEDIA_TYPE = [1 => 'sketch', 2 => 'picture'];
    public static $jsons = [];
    public static $messages = [];
    public static $rules = [
        'format_type' => 'required|string',
        'media_type' => 'required|integer|in:1,2',
        'date' => 'date',
        'user_id' => 'exists:users,id',
//        'location_id' => 'exists:locations,id',
//        'herbarium_id' => 'exists:herbariums,id',
//        'seed_id' => 'exists:seeds,id',
//        'paleontology_id' => 'exists:paleontologies,id',
//        'medicinal_plant_id' => 'exists:medicinal_plants,id',
//        'product_id' => 'exists:products,id',
//        'botanical_id' => 'exists:botanicals,id',
        'reference' => 'string',
        'description' => 'string',
    ];
    protected $appends = ['full_url'];
    protected $casts = [
        'manipulations' => 'array',
        'responsive_images' => 'array',
        'custom_properties' => 'array',
    ];
    protected $dates = ['date'];
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
