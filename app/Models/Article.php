<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Article",
 *      required={"title"}
 * )
 */
class Article extends BaseModel implements HasMedia
{
    use HasMediaTrait;
    public static $rules = [
        'page_no' => 'integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */

    protected $with = ['actors'];
    protected $appends = ['authors'];

    /**
     * @return MorphToMany
     */
    public function actors(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable',
            'actor_hubs')
            ->whereNull('actor_hubs.deleted_at')
            ->withTimestamps();
    }


    public function getAuthorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('actors') && $this->actors->count()) {
            $authors = $this->actors->implode('name', ' & ');
        }

        return $authors;
    }
}
