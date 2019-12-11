<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="PaleontologyCitation",
 *      required={"paleontology_id","authors"}
 * )
 */

class PaleontologyCitation extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontology_citations';


    public static $rules = [
        'year' => 'nullable|integer',
        'volume' => 'nullable|string',
        'pages' => 'nullable|string',
        'plates' => 'nullable|string',
        'publication_name' => 'required|string',
        'figures_number' => 'nullable|date',
        'paleontology_id' => 'required|exists:paleontologies,id',
    ];

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
