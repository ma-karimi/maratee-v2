<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\SeedCollectionRelations;
use App\Models\Scope\SeedCollectionScope;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="SeedCollection",
 *      required={"taxonomy_id"}
 * )
 */
class SeedCollection extends BaseModel implements HasMedia, AuditableContract
{

    use SeedCollectionRelations, SeedCollectionScope, HasMediaTrait, Auditable, AuditTrait;

    public static $climates = [
        'land_form_id' => 'nullable|exists:seed_generals,id',
        'slope_aspect_id' => 'nullable|exists:seed_generals,id',
        'slope_degree' => 'nullable|string',
        'general_habitat_id' => 'nullable|exists:seed_generals,id',
        'growth_form_id' => 'nullable|exists:seed_generals,id',
        'specimen_type_collect_id' => 'nullable|exists:seed_generals,id',
    ];
    public static $plants = [
//        'area_sampled' => 'nullable|integer',
        'approximare_area_of_plant' => 'nullable|integer',
        'plants_sampled_no' => 'nullable|integer',
        'area_occupancy' => 'nullable',
        'flowering_time_id' => 'nullable|exists:seed_generals,id',
//        'pollination_type_id' => 'nullable|exists:seed_generals,id',
//        'pollination_agent_id' => 'nullable|exists:seed_generals,id',
        'fruit_type_id' => 'nullable|exists:seed_generals,id',
        'date_harvesting_id' => 'nullable||exists:seed_generals,id',
        'plant_height' => 'nullable|string',
        'plant_mother_health_id' => 'nullable|exists:seed_generals,id',
        'plant_consumption_value_id' => 'nullable|exists:seed_generals,id',
//        'general_used_part_id' => 'required|exists:seed_generals,id',
//        'how_to_use' => 'nullable|string',
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
        'taxonomy_id' => 'nullable|exists:taxonomies,id',
        'encoded_code_by_collector' => 'nullable|string',
        'corrected_code_by_nrgb' => 'nullable|string',
        'accession_code' => 'required|string',
        'voucher_no' => 'nullable|string',
        'dna' => 'nullable|in:0,1'
    ];
    public static $projects = [
        'seed_collected_from_id' => 'nullable|exists:seed_generals,id',
        'project_title' => 'nullable|string',
        'project_no' => 'nullable|string',
        'project_leader_name' => 'nullable|string',
        'research_leader_name' => 'nullable|string',
        'organization_id' => 'nullable|exists:organizations,id',
    ];

    protected $with = ['taxonomy', 'audits'];
    protected $appends = ['last_audit', 'climate', 'associated_specie', 'community'];
}
