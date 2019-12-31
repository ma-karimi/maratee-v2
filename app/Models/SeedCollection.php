<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Relations\SeedCollectionRelations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="SeedCollection",
 *      required={"taxonomy_id"}
 * )
 */
class SeedCollection extends BaseModel implements HasMedia
{

    use SeedCollectionRelations, HasMediaTrait;
    public static $climates = [
        'land_form_id' => 'nullable|exists:seed_generals,id',
        'slope_aspect_id' => 'nullable|exists:seed_generals,id',
        'slope_degree' => 'nullable|string',
        'general_habitat_id' => 'nullable|exists:generals,id',
        'growth_form_id' => 'nullable|exists:seed_generals,id',
        'specimen_type_collect_id' => 'nullable|exists:seed_generals,id',
    ];
    public static $plants = [
        'area_sampled' => 'nullable|integer',
        'plants_sampled_no' => 'nullable|integer',
        'approximate_area_of_plant' => 'nullable|integer',
        'flowering_time_id' => 'nullable|integer',
        'pollination_type_id' => 'nullable|exists:seed_generals,id',
        'pollination_agent_id' => 'nullable|exists:seed_generals,id',
        'fruit_type_id' => 'nullable|exists:seed_generals,id',
        'date_harvesting_id' => 'nullable|integer',
        'plant_height' => 'nullable|integer',
        'plant_mother_health_id' => 'nullable|exists:seed_generals,id',
        'plant_consumption_value_id' => 'required|exists:seed_generals,id',
        'general_used_part_id' => 'required|exists:seed_generals,id',
        'how_to_use' => 'nullable|string',
        'other_details' => 'nullable|string',
        'special_advise' => 'nullable|string',
    ];
    public static $soils = [
        'soil_depth_id' => 'nullable|exists:seed_generals,id',
        'soil_texture_id' => 'nullable|exists:seed_generals,id',
        'drainage_id' => 'nullable|exists:seed_generals,id',
        'soil_ph' => 'nullable|string',
        'soil_salinity_id' => 'nullable|exists:seed_generals,id',
        'soil_lime_id' => 'nullable|exists:seed_generals,id',
        'soil_erosion_id' => 'nullable|exists:seed_generals,id',
    ];
    public static $rules = [
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'encoded_code_by_collector' => 'required|string',
        'corrected_code_by_nrgb' => 'required|string',
        'accession_code' => 'required|string',
        'voucher_no' => 'nullable|string',
        'dna'=>'nullable|in:0,1'
    ];
    public static $projects = [
        'seed_collected_from_id' => 'nullable|exists:seed_generals,id',
        'project.title' => 'required|string',
        'project.project_no' => 'required|string',
        'project.project_leader_name' => 'required|string',
        'project.research_leader_name' => 'required|string',
        'organization_id' => 'required|exists:organizations,id',
    ];
}
