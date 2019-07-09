<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Plants extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'author_id', 'created_at', 'deleted_at', 'description', 'domestic_name', 'location_id', 'name', 'plant_general_class_id', 'plant_general_cotyledon_id', 'plant_general_family_id', 'plant_general_flowering_id', 'plant_general_genus_id', 'plant_general_group_id', 'plant_general_order_id', 'plant_general_specie_id', 'plant_general_sperm_id', 'plant_general_sub_specie_id', 'plant_general_variety_id', 'updated_at', 'user_id'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];




    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
