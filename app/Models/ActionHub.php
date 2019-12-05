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
 *      required={"action_id"}
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

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'action_hubs';

    protected $with = ['actors'];
    protected $appends = ['authors'];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['date' => 'date'];

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


    public function getAuthorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('actors') && $this->actors->count()) {
            $authors = $this->actors->implode('name', ' & ');
        }

        return $authors;
    }
}
