<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Herbarium;
use App\Models\Plant;

class PlantGeneral extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_generals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'parent_id', 'type', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function herbariums()
    {
        return $this->hasMany(Herbarium::class, 'plant_group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany(Plant::class, [
            'plant_general_class_id',
            'plant_general_family_id',
            'plant_general_flowering_id',
            'plant_general_genus_id',
            'plant_general_group_id',
            'plant_general_order_id',
            'plant_general_specie_id',
            'plant_general_sperm_id',
            'plant_general_sub_specie_id',
            'plant_general_variety_id',
        ]);
    }

}
