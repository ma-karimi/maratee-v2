<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Visits extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visits';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['archive_no', 'archives_types', 'created_at', 'date', 'deleted_at', 'description', 'media_id', 'paleontology_id', 'peoples', 'purpose', 'updated_at', 'user_id'];



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
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

}
