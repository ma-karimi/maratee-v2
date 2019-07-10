<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlantFactor extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_factors';

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
        'description' => 'json'
    ];

    /**
     * @return HasMany
     */
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class, 'plant_origin_id')->latest();
    }

    /**
     * @return HasMany
     */
    public function plantApplications(): HasMany
    {
        return $this->hasMany(PlantApplication::class, ['plant_factor_application_id', 'plant_factor_growth_id', 'plant_factor_industry_id', 'plant_factor_part_id', 'plant_factor_usage_type_id'])->latest();
    }

}
