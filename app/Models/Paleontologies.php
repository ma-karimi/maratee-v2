<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Paleontologies extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['access', 'additional_info', 'barcode_no', 'catalog_no', 'closet', 'collection_name', 'color', 'common_name', 'created_at', 'deleted_at', 'drawer', 'element', 'excavation', 'field_no', 'geology_age_id', 'infraspecific', 'last_update', 'location_no', 'move_status', 'pieces', 'preservation', 'salon', 'specimen_no', 'treatment', 'typestatus', 'updated_at'];



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
    protected $dates = ['created_at', 'deleted_at', 'last_update', 'updated_at'];

    public function exchanges()
    {
        return $this->hasMany(Exchange::class, ['send_paleontology_id', 'receive_paleontology_id'])->latest();
    }
}
