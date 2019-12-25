<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use App\Models\Department;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="SeedCollection",
 *      required={"seed_id","location_id","plant_consumption_value_id","general_used_part_id"}
 * )
 */
class SeedCollection extends BaseModel
{
    public static $rules = [
        'seed_id' => 'required|exists:seeds,id',
        'location_id' => 'required|exists:locations,id',
        'land_form_id' => 'exists:seed_generals,id',
        'slope_aspect_id' => 'exists:seed_generals,id',
        'slope_degree' => 'string',
        'general_habitat_id' => 'exists:generals,id',
        'soil_depth_id' => 'exists:seed_generals,id',
        'soil_texture_id' => 'exists:seed_generals,id',
        'drainage_id' => 'exists:seed_generals,id',
        'soil_ph' => 'string',
        'soil_salinity_id' => 'exists:seed_generals,id',
        'soil_lime_id' => 'exists:seed_generals,id',
//        'climate' => 'string',
//        'community_type' => 'string',
        'soil_erosion_id' => 'exists:seed_generals,id',
        'area_sampled' => 'integer',
        'plants_sampled_no' => 'integer',
        'approximate_area_of_plant' => 'integer',
        'flowering_time_id' => 'integer',
        'pollination_type_id' => 'exists:seed_generals,id',
        'pollination_agent_id' => 'exists:seed_generals,id',
        'fruit_type_id' => 'exists:seed_generals,id',
        'seed_collected_from_id' => 'exists:seed_generals,id',
        'date_harvesting_id' => 'integer',
        'life_form_id' => 'exists:seed_generals,id',
        'growth_form_id' => 'exists:seed_generals,id',
        'plant_height' => 'integer',
        'plant_mother_health_id' => 'exists:seed_generals,id',
        'plant_consumption_value_id' => 'required|exists:seed_generals,id',
        'general_used_part_id' => 'required|exists:seed_generals,id',
        'how_to_use' => 'string',
        'other_details' => 'string',
        'special_advise' => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo(Seed::class);
    }

    /**
     * @return BelongsTo
     */
    public function drainage()
    {
        return $this->belongsTo(SeedGeneral::class, 'drainage_id');
    }

    /**
     * @return BelongsTo
     */
    public function fruitType()
    {
        return $this->belongsTo(SeedGeneral::class, 'fruit_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalHabitat()
    {
        return $this->belongsTo(General::class, 'general_habitat_id');
    }

    /**
     * @return BelongsTo
     */
    public function generalUsedPart()
    {
        return $this->belongsTo(SeedGeneral::class, 'general_used_part_id');
    }

    /**
     * @return BelongsTo
     */
    public function growthForm()
    {
        return $this->belongsTo(SeedGeneral::class, 'growth_form_id');
    }

    /**
     * @return BelongsTo
     */
    public function lifeForm()
    {
        return $this->belongsTo(SeedGeneral::class, 'life_form_id');
    }

    /**
     * @return BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    /**
     * @return BelongsTo
     */
    public function plantConsumptionValue()
    {
        return $this->belongsTo(SeedGeneral::class, 'plant_consumption_value_id');
    }

    /**
     * @return BelongsTo
     */
    public function plantMotherHealth()
    {
        return $this->belongsTo(SeedGeneral::class, 'plant_mother_health_id');
    }

    /**
     * @return BelongsTo
     */
    public function pollinationAgent()
    {
        return $this->belongsTo(SeedGeneral::class, 'pollination_agent_id');
    }

    /**
     * @return BelongsTo
     */
    public function pollinationType()
    {
        return $this->belongsTo(SeedGeneral::class, 'pollination_type_id');
    }


    /**
     * @return BelongsTo
     */
    public function seedCollectedFrom()
    {
        return $this->belongsTo(SeedGeneral::class, 'seed_collected_from_id');
    }

    /**
     * @return BelongsTo
     */
    public function slopeAspect()
    {
        return $this->belongsTo(SeedGeneral::class, 'slope_aspect_id');
    }

    /**
     * @return BelongsTo
     */
    public function soilDepth()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_depth_id');
    }

    /**
     * @return BelongsTo
     */
    public function soilErosion()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_erosion_id');
    }

    /**
     * @return BelongsTo
     */
    public function soilLime()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_lime_id');
    }

    /**
     * @return BelongsTo
     */
    public function soilSalinity()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_salinity_id');
    }

    /**
     * @return BelongsTo
     */
    public function soilTexture()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_texture_id');
    }

    /**
     * @return BelongsTo
     */
    public function specimenType()
    {
        return $this->belongsTo(SeedGeneral::class, 'specimen_type_id');
    }
}
