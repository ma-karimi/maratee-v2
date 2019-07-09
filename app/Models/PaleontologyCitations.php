<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class PaleontologyCitations extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontology_citations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'created_at', 'deleted_at', 'media_id', 'paleontology_id', 'plates_no', 'updated_at', 'user_id'];

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



}
