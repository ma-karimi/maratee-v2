<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Relations\ArticleRelation;
use App\Models\Scope\ActionHubScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="ActionHub",
 *      required={"action_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="project_id",
 *          description="project_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="action_id",
 *          description="action_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="department_id",
 *          description="department_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class ActionHub extends BaseModel
{
    use ActionHubScope, ArticleRelation;
    public static $rules = [
//        'action_id' => 'required|exists:actions,id',
        'department_id' => 'exists:departments,id',
        'project_id' => 'exists:projects,id',
        'date' => 'date',
    ];
    //public static $linguistically = ['description' => false];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'action_hubs';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['description' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function actionable(): MorphTo
    {
        return $this->morphTo('actionable');
    }

    public function actors(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable', 'actor_hubs')->withTimestamps()->whereNull('actor_hubs.deleted_at');
    }
//
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

    /**
     * Get the owning actionable model.
     */

}
