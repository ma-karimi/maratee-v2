<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Permission extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'set_name', 'set_value', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'set_name'=>'json',
        'set_value'=>'json',
    ];



}
