<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeedExchanges extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_exchanges';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['approval_no', 'collection_id', 'created_at', 'date', 'deleted_at', 'description', 'saved_type', 'seed_id', 'type', 'updated_at', 'weight'];

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
