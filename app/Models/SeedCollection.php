<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Taxonomy;
use App\Models\Organization;
use App\Models\Location;
use App\Models\General;
use App\Models\Department;
use App\Models\SeedGeneral;

/**
 * @SWG\Definition(
 *      definition="SeedCollection",
 *      required={"seed_id","location_id","plant_consumption_value_id","general_used_part_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="voucher_no",
 *          description="voucher_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="taxonomy_id",
 *          description="taxonomy_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="encoded_code_by_collector",
 *          description="encoded_code_by_collector",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="corrected_code_by_nrgb",
 *          description="corrected_code_by_nrgb",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="land_form_id",
 *          description="land_form_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="slope_aspect_id",
 *          description="slope_aspect_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="slope_degree",
 *          description="slope_degree",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="general_habitat_id",
 *          description="general_habitat_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="soil_depth_id",
 *          description="soil_depth_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="soil_texture_id",
 *          description="soil_texture_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="drainage_id",
 *          description="drainage_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="soil_ph",
 *          description="soil_ph",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="soil_salinity_id",
 *          description="soil_salinity_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="soil_lime_id",
 *          description="soil_lime_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="climate",
 *          description="climate",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="community_type",
 *          description="community_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="soil_erosion_id",
 *          description="soil_erosion_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="area_sampled",
 *          description="area_sampled",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="plants_sampled_no",
 *          description="plants_sampled_no",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="approximate_area_of_plant",
 *          description="approximate_area_of_plant",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="specimen_type_id",
 *          description="specimen_type_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="flowering_time_id",
 *          description="1 => January ,2 => February ,3 => March ,4 => April ,5 => May ,6 => June ,7 => July ,8 => August ,9 => September ,10 => October ,11 => November ,12 => December",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="pollination_type_id",
 *          description="pollination_type_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="pollination_agent_id",
 *          description="pollination_agent_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="fruit_type_id",
 *          description="fruit_type_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="seed_collected_from_id",
 *          description="seed_collected_from_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="date_harvesting_id",
 *          description="1 => January ,2 => February ,3 => March ,4 => April ,5 => May ,6 => June ,7 => July ,8 => August ,9 => September ,10 => October ,11 => November ,12 => December",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="life_form_id",
 *          description="life_form_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="growth_form_id",
 *          description="growth_form_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="plant_height",
 *          description="plant_height",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="plant_mother_health_id",
 *          description="plant_mother_health_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="plant_consumption_value_id",
 *          description="plant_consumption_value_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="general_used_part_id",
 *          description="general_used_part_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="how_to_use",
 *          description="how_to_use",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="other_details",
 *          description="other_details",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="special_advise",
 *          description="special_advise",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class SeedCollection extends BaseModel
{
    public static $rules = [
        'seed_id' => 'required|exists:seeds,id',
        'location_id' =>'required|exists:locations,id',
        'land_form_id' =>'exists:seed_generals,id',
        'slope_aspect_id' =>'exists:seed_generals,id',
        'slope_degree' =>'string',
        'general_habitat_id' =>'exists:generals,id',
        'soil_depth_id' =>'exists:seed_generals,id',
        'soil_texture_id' =>'exists:seed_generals,id',
        'drainage_id' =>'exists:seed_generals,id',
        'soil_ph' =>'string',
        'soil_salinity_id' =>'exists:seed_generals,id',
        'soil_lime_id' =>'exists:seed_generals,id',
        'climate' =>'string',
        'community_type' =>'string',
        'soil_erosion_id' =>'exists:seed_generals,id',
        'area_sampled' =>'integer',
        'plants_sampled_no' =>'integer',
        'approximate_area_of_plant' =>'integer',
        'flowering_time_id' =>'integer',
        'pollination_type_id' =>'exists:seed_generals,id',
        'pollination_agent_id' =>'exists:seed_generals,id',
        'fruit_type_id' =>'exists:seed_generals,id',
        'seed_collected_from_id' =>'exists:seed_generals,id',
        'date_harvesting_id' =>'integer',
        'life_form_id' =>'exists:seed_generals,id',
        'growth_form_id' =>'exists:seed_generals,id',
        'plant_height' =>'integer',
        'plant_mother_health_id' =>'exists:seed_generals,id',
        'plant_consumption_value_id' =>'required|exists:seed_generals,id',
        'general_used_part_id' =>'required|exists:seed_generals,id',
        'how_to_use' =>'string',
        'other_details' =>'string',
        'special_advise' =>'string',
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
