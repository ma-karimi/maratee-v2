<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchanges extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exchanges';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'receive_date', 'receive_herbarium_id1', 'receive_paleontology_id1', 'receive_sample_no', 'receive_sheet_no', 'receive_type', 'send_date', 'send_herbarium_id', 'send_paleontology_id', 'send_sample_no', 'send_sheet_no', 'send_type', 'updated_at'];

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
    protected $dates = ['created_at', 'deleted_at', 'receive_date', 'send_date', 'updated_at'];

}
