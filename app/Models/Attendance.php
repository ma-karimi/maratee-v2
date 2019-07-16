<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *            name="Attendance",
 *            required={"start_time", "end_time", "user_id"},
 * 			@SWG\Property(name="start_time", type="string"),
 * 			@SWG\Property(name="end_time", type="string"),
 * 			@SWG\Property(name="user_id", type="integer"),
 * 			@SWG\Property(name="herbarium_id", type="integer"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class Attendance extends BaseModel
{

    public static $rules = [
        'start_time' => 'required|datetime',
        'end_time' => 'required|datetime',
        'user_id' => 'exists:users,id',
        'herbarium_id' => 'exists:herbariums,id'
    ];

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
        return $this->belongsTo(Herbarium::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
