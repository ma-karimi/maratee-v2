<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'borrow';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['borrow_date', 'created_at', 'deadline', 'deleted_at', 'herbarium_id', 'media_id', 'person_id', 'return', 'sheets_no', 'status_id', 'updated_at'];

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
    protected $dates = ['borrow_date', 'created_at', 'deadline', 'deleted_at', 'return', 'updated_at'];

}
