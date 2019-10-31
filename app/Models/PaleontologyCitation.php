<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="PaleontologyCitation",
 *      required={"paleontology_id","actor_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="paleontology_id",
 *          description="paleontology_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="actor_id",
 *          description="actor_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="year",
 *          description="year",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="volume",
 *          description="volume",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="pages",
 *          description="pages",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="plates",
 *          description="plates",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="figures_number",
 *          description="figures_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="publication_name",
 *          description="publication_name",
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
