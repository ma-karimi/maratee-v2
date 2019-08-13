<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *            definition="Borrow",
 *            required={"start_time", "end_time", "user_id"},
 * 			@SWG\Property(property="borrows_date", type="string"),
 * 			@SWG\Property(property="sheets_no", type="string"),
 * 			@SWG\Property(property="user_id", type="integer"),
 * 			@SWG\Property(property="media_id", type="integer"),
 * 			@SWG\Property(property="herbarium_id", type="integer"),
 * 			@SWG\Property(property="deadline", type="integer"),
 * 			@SWG\Property(property="return", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Borrow extends BaseModel
{

    public static $rules = [
        'media_id' => 'exists:medias,id',
        'borrows_date' => 'required|datetime',
        'deadline' => 'required|date',
        'sheets_no' => 'required|integer',
        'user_id' => 'exists:users,id',
        'herbarium_id' => 'exists:herbariums,id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'borrows';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['borrows_date', 'created_at', 'deadline', 'deleted_at', 'herbarium_id', 'media_id', 'return', 'sheets_no', 'updated_at', 'user_id'];



    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['borrows_date', 'created_at', 'deadline', 'deleted_at', 'return', 'updated_at'];

    public function herbarium()
    {
        return $this->belongsTo(Herbarium::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function borrowable()
    {
        return $this->morphTo();
    }
}
