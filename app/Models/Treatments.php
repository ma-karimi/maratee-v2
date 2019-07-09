<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Treatments extends BaseModel
{


    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'treatments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'paleontology_id', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json'
    ];



    public function paleontology()
    {
        return $this->belongsTo(Paleontologies::class, 'paleontology_id');
    }

}
