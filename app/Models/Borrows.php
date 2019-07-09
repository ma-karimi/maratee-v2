<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrows extends Model  
{

    

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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

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

}
