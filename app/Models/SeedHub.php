<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedHub extends BaseModel
{


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
