<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\ActionHubScope;

/**
 * @SWG\Definition(
 *      definition="ActionHub",
 *      required={"action_id", "user_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="herbarium_id",
 *          description="herbarium_id",
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
 *          property="location_id",
 *          description="location_id",
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
    use ActionHubScope;
    public static $rules = [
        'action_id' => 'required|exists:actions,id',
        'department_id' => 'exists:departments,id',
        'herbarium_id' => 'exists:herbariums,id',
        'project_id' => 'exists:projects,id',
        'location_id' => 'exists:locations,id',
        'date' => 'date',
    ];
    public static $linguistically = ['description' => false];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'action_hubs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['action_id', 'created_at', 'date', 'deleted_at', 'department_id', 'description', 'herbarium_id', 'location_id', 'project_id', 'updated_at', 'user_id'];


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


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function herbarium()
    {
        return $this->belongsTo(Herbarium::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
