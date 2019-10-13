<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $taxonomy_id
 * @property integer $organization_id
 * @property integer $department_id
 * @property integer $project_id
 * @property integer $location_id
 * @property integer $slope_aspect_id
 * @property integer $general_habitat_id
 * @property integer $soil_depth_id
 * @property integer $soil_texture_id
 * @property integer $drainage_id
 * @property integer $soil_salinity_id
 * @property integer $soil_lime_id
 * @property integer $soil_erosion_id
 * @property integer $specimen_type_id
 * @property integer $pollination_type_id
 * @property integer $pollination_agent_id
 * @property integer $fruit_type_id
 * @property integer $seed_collected_from_id
 * @property integer $life_form_id
 * @property integer $growth_form_id
 * @property integer $plant_mother_health_id
 * @property integer $plant_consumption_value_id
 * @property integer $general_used_part_id
 * @property string $voucher_no
 * @property string $encoded_code_by_collector
 * @property string $corrected_code_by_nrgb
 * @property string $accession_released_code_by_nrgb
 * @property integer $land_form_id
 * @property string $slope_degree
 * @property string $soil_ph
 * @property string $climate
 * @property string $community_type
 * @property int $area_sampled
 * @property int $plants_sampled_no
 * @property int $approximate_area_of_plant
 * @property boolean $flowering_time_id
 * @property boolean $date_harvesting_id
 * @property int $plant_height
 * @property string $how_to_use
 * @property string $other_details
 * @property string $special_advise
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Department $department
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property General $general
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property Location $location
 * @property Organization $organization
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property Project $project
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property SeedGeneral $seedGeneral
 * @property Taxonomy $taxonomy
 */
class App\Models\SeedCollection extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'seed_collections';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['taxonomy_id', 'organization_id', 'department_id', 'project_id', 'location_id', 'slope_aspect_id', 'general_habitat_id', 'soil_depth_id', 'soil_texture_id', 'drainage_id', 'soil_salinity_id', 'soil_lime_id', 'soil_erosion_id', 'specimen_type_id', 'pollination_type_id', 'pollination_agent_id', 'fruit_type_id', 'seed_collected_from_id', 'life_form_id', 'growth_form_id', 'plant_mother_health_id', 'plant_consumption_value_id', 'general_used_part_id', 'voucher_no', 'encoded_code_by_collector', 'corrected_code_by_nrgb', 'accession_released_code_by_nrgb', 'land_form_id', 'slope_degree', 'soil_ph', 'climate', 'community_type', 'area_sampled', 'plants_sampled_no', 'approximate_area_of_plant', 'flowering_time_id', 'date_harvesting_id', 'plant_height', 'how_to_use', 'other_details', 'special_advise', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'drainage_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'fruit_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function general()
    {
        return $this->belongsTo('App\Models\General', 'general_habitat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'general_used_part_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'growth_form_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'life_form_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'plant_consumption_value_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'plant_mother_health_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'pollination_agent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
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
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'seed_collected_from_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'slope_aspect_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_depth_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_erosion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_lime_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_salinity_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'soil_texture_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seedGeneral()
    {
        return $this->belongsTo('App\Models\SeedGeneral', 'specimen_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxonomy()
    {
        return $this->belongsTo('App\Models\Taxonomy');
    }
}
