<?php

namespace App\Models;

use App\Models\Accessor\MediaAccessor;
use App\Models\Relations\ArticleRelation;
use App\Models\Relations\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

/**
 * @SWG\Definition(
 *      definition="Media",
 *      required={"name","media_type"},
 * )
 */
class Media extends BaseMedia
{
    //use BaseModelTrait instead of BaseModel Class
    use BaseModel, MediaAccessor, ArticleRelation;

    public const MEDIA_TYPE = [1 => 'sketch', 2 => 'picture', 3 => 'relevant correspondence', 4 => 'treatment document', 5 => 'expense documents', 6 => 'filed notes', 7 => 'notes'];
    public static $jsons = [];
    public static $messages = [];
    public static $linguistically = [];
    public static $rules = [
        'model_type' => 'required',
        'model_id' => 'required',
        'media_type' => 'required|integer|in:1,2',
    ];
    protected $appends = ['full_url', 'media_type_name'];
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
