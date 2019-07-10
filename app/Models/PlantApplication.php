<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlantApplication extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plant_applications';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['plant_factor_application_id', 'created_at', 'deleted_at', 'herbarium_id', 'plant_factor_growth_id', 'plant_factor_industry_id', 'plant_factor_part_id', 'plant_factor_usage_type_id', 'presence', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'presence' => 'json'
    ];

    /**
     * @return BelongsTo
     */
    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
    }

    /**
     * @return BelongsTo
     */
    public function plantFactorApplication(): BelongsTo
    {
        return $this->belongsTo(PlantFactor::class, 'plant_factor_application_id');
    }

    /**
     * @return BelongsTo
     */
    public function plantFactorGrowth(): BelongsTo
    {
        return $this->belongsTo(PlantFactor::class, 'plant_factor_growth_id');
    }

    /**
     * @return BelongsTo
     */
    public function plantFactorIndustry(): BelongsTo
    {
        return $this->belongsTo(PlantFactor::class, 'plant_factor_industry_id');
    }

    /**
     * @return BelongsTo
     */
    public function plantFactorPart(): BelongsTo
    {
        return $this->belongsTo(PlantFactor::class, 'plant_factor_part_id');
    }

    /**
     * @return BelongsTo
     */
    public function plantFactorUsage(): BelongsTo
    {
        return $this->belongsTo(PlantFactor::class, 'plant_factor_usage_type_id');
    }

}
