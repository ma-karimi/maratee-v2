<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="PaleontologyCitation",
 *      required={"paleontology_id","actor_id"}
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
        'year' => 'integer',
        'volume' => 'string',
        'pages' => 'string',
        'plates' => 'string',
        'publication_name' => 'string',
        'figures_number' => 'date',
        'paleontology_id' => 'integer|exists:paleontologies,id',
        'author_id' => 'integer|exists:actors,id',
    ];


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
}
