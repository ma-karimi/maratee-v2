<?php

namespace App\Models;

use App\Models\Convert\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Taxonomy;
use App\Models\Organization;
use App\Models\Location;
use App\Models\General;
use App\Models\Department;

/**
 * @SWG\Definition(
 *      definition="SeedCollection",
 *      required={"taxonomy_id","organization_id","location_id","plant_consumption_value_id","general_used_part_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="taxonomy_id",
 *          description="taxonomy_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="organization_id",
 *          description="organization_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="department_id",
 *          description="department_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="project_id",
 *          description="project_id",
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
 *          property="accession_released_code_by_nrgb",
 *          description="accession_released_code_by_nrgb",
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
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'organization_id' => 'required|exists:organizations,id',
        'location_id' =>'required|exists:locations,id',
        'plant_consumption_value_id' =>'required|exists:seed_generals,id',
        'general_used_part_id' =>'required|exists:seed_generals,id',
        'department_id' =>'exists:departments,id',
        'project_id' =>'exists:projects,id',
        'land_form_id' =>'exists:seed_generals,id',
        'slope_aspect_id' =>'exists:seed_generals,id',
        'general_habitat_id' =>'exists:generals,id',
        'soil_depth_id' =>'exists:seed_generals,id',
        'soil_texture_id' =>'exists:seed_generals,id',
        'soil_salinity_id' =>'exists:seed_generals,id',
        'soil_lime_id' =>'exists:seed_generals,id',
        'drainage_id' =>'exists:seed_generals,id',
        'soil_erosion_id' =>'exists:seed_generals,id',
        'specimen_type_id' =>'exists:seed_generals,id',
        'pollination_type_id' =>'exists:seed_generals,id',
        'pollination_agent_id' =>'exists:seed_generals,id',
        'fruit_type_id' =>'exists:seed_generals,id',
        'seed_collected_from_id' =>'exists:seed_generals,id',
        'life_form_id' =>'exists:seed_generals,id',
        'growth_form_id' =>'exists:seed_generals,id',
        'plant_mother_health_id' =>'exists:seed_generals,id',
        'encoded_code_by_collector' =>'string',
        'corrected_code_by_nrgb' =>'string',
        'accession_released_code_by_nrgb' =>'string',
        'slope_degree' =>'string',
        'soil_ph' =>'string',
        'climate' =>'string',
        'community_type' =>'string',
        'area_sampled' =>'integer',
        'plants_sampled_no' =>'integer',
        'approximate_area_of_plant' =>'integer',
        'flowering_time_id' =>'integer',
        'date_harvesting_id' =>'integer',
        'plant_height' =>'integer',
        'how_to_use' =>'string',
        'other_details' =>'string',
        'special_advise' =>'string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drainage()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'drainage_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fruitType()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'fruit_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function generalHabitat()
    {
        return $this->belongsTo(General::class, 'general_habitat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function generalUsedPart()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'general_used_part_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function growthForm()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'growth_form_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lifeForm()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'life_form_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantConsumptionValue()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'plant_consumption_value_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantMotherHealth()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'plant_mother_health_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pollinationAgent()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'pollination_agent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pollinationType()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'pollination_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedCollectedFrom()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'seed_collected_from_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slopeAspect()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'slope_aspect_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soilDepth()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_depth_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soilErosion()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_erosion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soilLime()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_lime_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soilSalinity()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_salinity_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soilTexture()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_texture_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specimenType()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'specimen_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }
}
