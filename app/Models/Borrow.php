<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends BaseModel
{


    use SoftDeletes;
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
}
