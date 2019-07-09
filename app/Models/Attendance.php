<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Attendance extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attendances';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'end_time', 'herbarium_id', 'start_time', 'updated_at', 'user_id'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'end_time', 'start_time', 'updated_at'];


    public function herbarium()
    {
        return $this->belongsTo(Herbariums::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
