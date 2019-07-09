<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryoBanks extends Model  
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cryo_banks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cell_no', 'created_at', 'deleted_at', 'entry_date', 'geotype_code', 'herbarium_id', 'layering_no', 'protection_id', 'rack_no', 'repetition', 'row_no', 'sample_type', 'tank_no', 'tank_type', 'treatment', 'updated_at', 'voucher_number'];

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
    protected $dates = ['created_at', 'deleted_at', 'entry_date', 'updated_at'];

}
