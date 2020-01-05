<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="Citation",
 *      required={"publication_name","authors"}
 * )
 */
class Citation extends BaseModel
{

    public static $rules = [
        'year' => 'required|integer',
        'volume' => 'nullable|string',
        'pages' => 'nullable|string',
        'plates' => 'nullable|string',
        'publication_name' => 'required|string',
        'figures_number' => 'nullable|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'citations';
    protected $with = ['actors'];
    protected $appends = ['authors', 'name'];

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

    public function getNameAttribute()
    {
        return $this->publication_name;
    }
}
