<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Language extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'created_at', 'deleted_at', 'name', 'updated_at'];


}
