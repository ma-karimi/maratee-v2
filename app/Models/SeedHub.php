<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="SeedHub",
 *      required={"user_id","seed_id","location_id","action_id"},
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
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="action_role",
 *          description="action_role",
 *          type="array",
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="action_role_description",
 *          description="action_role_description",
 *          type="array",
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
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
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date"
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

class SeedHub extends BaseModel
{
    public static $rules=[
        'project_id' => 'exists:projects,id',
        'user_id' => 'required|exists:seeds,id',
        'seed_id' => 'required|integer',
        'location_id' => 'required|integer',
        'action_id' => 'required|integer',
        'date' => 'date',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_hubs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['action_id', 'action_role', 'action_role_description', 'created_at', 'date', 'deleted_at', 'location_id', 'project_id', 'seed_id', 'updated_at', 'user_id'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'action_role' => 'json',
        'action_role_description' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seed()
    {
        return $this->belongsTo(Seed::class, 'seed_id');
    }

    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }


}
