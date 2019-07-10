<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedExchanges extends BaseModel
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'approval_no'=>'json',
        'saved_type'=>'json',
        'description'=>'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo('App\Models\Collection');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo('App\Models\Seed');
    }

}
