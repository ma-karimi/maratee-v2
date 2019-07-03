<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeedExchange extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_exchange';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['approval_no', 'collection_id', 'created_at', 'date', 'deleted_at', 'description', 'person_id', 'saved_type', 'seed_id', 'status_id', 'type', 'updated_at', 'weight'];

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
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

}
