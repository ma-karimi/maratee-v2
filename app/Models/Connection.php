<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Connection extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'connections';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'department_id', 'location_id', 'updated_at'];






    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
