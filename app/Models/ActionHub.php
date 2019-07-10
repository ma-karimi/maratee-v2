<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class ActionHub extends BaseModel
{


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
        return $this->belongsTo(Herbariums::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
