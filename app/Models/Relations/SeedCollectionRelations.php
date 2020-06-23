<?php


namespace App\Models\Relations;


use App\Models\General;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Seed;
use App\Models\SeedGeneral;
use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait SeedCollectionRelations
{

    /**
     * @return BelongsTo
     */
    public function drainage(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'drainage_id')->where('seed_generals.type_id', 6);
    }

    /**
     * @return BelongsTo
     */
    public function fruitType(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'fruit_type_id')->where('seed_generals.type_id', 12);
    }

    /**
     * @return BelongsTo
     */
    public function habitat(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_habitat_id');
    }

    /**
     * @return BelongsTo
     */
    public function usedPart(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'general_used_part_id')->where('seed_generals.type_id', 18);
    }

    /**
     * @return BelongsTo
     */
    public function growthForm(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'growth_form_id')->where('seed_generals.type_id', 15);
    }

    /**
     * @return BelongsTo
     */
    public function floweringTime(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'flowering_time_id')->where('seed_generals.type_id', 25);
    }

    /**
     * @return BelongsTo
     */
    public function harvestingTime(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'harvesting_time_id')->where('seed_generals.type_id', 25);
    }

    /**
     * @return BelongsTo
     */
    public function lifeForm(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'life_form_id')->where('seed_generals.type_id', 14);
    }

    /**
     * @return BelongsTo
     */
    public function landForm(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'land_form_id')->where('seed_generals.type_id', 2);
    }

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }


    /**
     * @return BelongsTo
     */
    public function consumption(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'plant_consumption_value_id')->where('seed_generals.type_id', 17);
    }

    /**
     * @return BelongsTo
     */
    public function motherHealth(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'plant_mother_health_id')->where('seed_generals.type_id', 16);
    }

    /**
     * @return BelongsTo
     */
    public function pollinationAgent(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'pollination_agent_id')->where('seed_generals.type_id', 11);
    }

    /**
     * @return BelongsTo
     */
    public function pollinationType(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'pollination_type_id')->where('seed_generals.type_id', 10);
    }


    /**
     * @return BelongsTo
     */
    public function collectedFrom(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'seed_collected_from_id')->where('seed_generals.type_id', 13);
    }

    /**
     * @return BelongsTo
     */
    public function slopeAspect(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'slope_aspect_id')->where('seed_generals.type_id', 3);
    }

    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class, 'taxonomy_id')->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function soilDepth(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_depth_id')->where('seed_generals.type_id', 4);
    }

    /**
     * @return BelongsTo
     */
    public function soilErosion(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_erosion_id')->where('seed_generals.type_id', 9);
    }

    /**
     * @return BelongsTo
     */
    public function soilLime(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_lime_id')->where('seed_generals.type_id', 8);
    }

    /**
     * @return BelongsTo
     */
    public function soilSalinity(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_salinity_id')->where('seed_generals.type_id', 7);
    }

    /**
     * @return BelongsTo
     */
    public function soilTexture(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_texture_id')->where('seed_generals.type_id', 5);
    }

    /**
     * @return BelongsTo
     */
    public function specimenType(): BelongsTo
    {
        return $this->belongsTo(SeedGeneral::class, 'specimen_type_collect_id')->where('seed_generals.type_id', 1);
    }

    public function getClimateAttribute()
    {
        $item = null;
        if ($this->relationLoaded('climates') && $this->climates()->count()) {
            $item .= $this->climates->implode('name', ' & ');

        }

        return $item;
    }

    /**
     * @return BelongsToMany
     */
    public function climates(): BelongsToMany
    {
        return $this->belongsToMany(SeedGeneral::class, 'seed_general_collections')->where('seed_generals.type_id', 20)->latest()->withTimestamps();
    }

    public function getAssociatedSpecieAttribute()
    {
        $item = null;
        if ($this->relationLoaded('associatedSpecies') && $this->associatedSpecies()->count()) {
            $item .= $this->associatedSpecies->implode('name', ' & ');

        }

        return $item;
    }

    /**
     * @return BelongsToMany
     */
    public function associatedSpecies(): BelongsToMany
    {
        return $this->belongsToMany(SeedGeneral::class, 'seed_general_collections')
            ->where('seed_generals.type_id', 22)
            ->latest()->withTimestamps()->whereNull('seed_general_collections.deleted_at');
    }

    public function getCommunityAttribute()
    {
        $item = null;
        if ($this->relationLoaded('communityTypes') && $this->communityTypes()->count()) {
            $item .= $this->communityTypes->implode('name', ' & ');

        }

        return $item;
    }

    /**
     * @return BelongsToMany
     */
    public function communityTypes(): BelongsToMany
    {
        return $this->belongsToMany(SeedGeneral::class, 'seed_general_collections')
            ->where('seed_generals.type_id', 21)->latest()->withTimestamps()
            ->whereNull('seed_general_collections.deleted_at');
    }
}
