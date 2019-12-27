<?php


namespace App\Models\Relations;


use App\Models\ActionHub;
use App\Models\General;
use App\Models\Location;
use App\Models\Seed;
use App\Models\SeedGeneral;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait SeedCollectionRelations
{


    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }

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
        return $this->belongsTo(SeedGeneral::class, 'drainage_id')->where('seed_generals.type_id', 7);
    }

    /**
     * @return BelongsTo
     */
    public function fruitType()
    {
        return $this->belongsTo(SeedGeneral::class, 'fruit_type_id')->where('seed_generals.type_id', 13);
    }

    /**
     * @return BelongsTo
     */
    public function habitat()
    {
        return $this->belongsTo(General::class, 'general_habitat_id');
    }

    /**
     * @return BelongsTo
     */
    public function usedPart()
    {
        return $this->belongsTo(SeedGeneral::class, 'general_used_part_id')->where('seed_generals.type_id', 18);
    }

    /**
     * @return BelongsTo
     */
    public function growthForm()
    {
        return $this->belongsTo(SeedGeneral::class, 'growth_form_id')->where('seed_generals.type_id', 15);
    }

    /**
     * @return BelongsTo
     */
    public function lifeForm()
    {
        return $this->belongsTo(SeedGeneral::class, 'life_form_id')->where('seed_generals.type_id', 14);
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
    public function consumptionValue()
    {
        return $this->belongsTo(SeedGeneral::class, 'plant_consumption_value_id')->where('seed_generals.type_id', 17);
    }

    /**
     * @return BelongsTo
     */
    public function motherHealth()
    {
        return $this->belongsTo(SeedGeneral::class, 'plant_mother_health_id')->where('seed_generals.type_id', 16);
    }

    /**
     * @return BelongsTo
     */
    public function pollinationAgent()
    {
        return $this->belongsTo(SeedGeneral::class, 'pollination_agent_id')->where('seed_generals.type_id', 11);
    }

    /**
     * @return BelongsTo
     */
    public function pollinationType()
    {
        return $this->belongsTo(SeedGeneral::class, 'pollination_type_id')->where('seed_generals.type_id', 10);
    }


    /**
     * @return BelongsTo
     */
    public function collectedFrom()
    {
        return $this->belongsTo(SeedGeneral::class, 'seed_collected_from_id')->where('seed_generals.type_id', 13);
    }

    /**
     * @return BelongsTo
     */
    public function slopeAspect()
    {
        return $this->belongsTo(SeedGeneral::class, 'slope_aspect_id')->where('seed_generals.type_id', 3);
    }

    /**
     * @return BelongsTo
     */
    public function soilDepth()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_depth_id')->where('seed_generals.type_id', 4);
    }

    /**
     * @return BelongsTo
     */
    public function soilErosion()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_erosion_id')->where('seed_generals.type_id', 9);
    }

    /**
     * @return BelongsTo
     */
    public function soilLime()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_lime_id')->where('seed_generals.type_id', 8);
    }

    /**
     * @return BelongsTo
     */
    public function soilSalinity()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_salinity_id')->where('seed_generals.type_id', 7);
    }

    /**
     * @return BelongsTo
     */
    public function soilTexture()
    {
        return $this->belongsTo(SeedGeneral::class, 'soil_texture_id')->where('seed_generals.type_id', 5);
    }

    /**
     * @return BelongsTo
     */
    public function specimenType()
    {
        return $this->belongsTo(SeedGeneral::class, 'specimen_type_id')->where('seed_generals.type_id', 1);
    }

    /**
     * @return BelongsToMany
     */
    public function associatedSpecies()
    {
        return $this->belongsToMany(SeedGeneral::class, 'seed_general_collections')->where('seed_generals.type_id', 22)->latest();
    }

    /**
     * @return BelongsToMany
     */
    public function communityTypes()
    {
        return $this->belongsToMany(SeedGeneral::class, 'seed_general_collections')->where('seed_generals.type_id', 21)->latest();
    }
    /**
     * @return BelongsToMany
     */
    public function climates()
    {
        return $this->belongsToMany(SeedGeneral::class, 'seed_general_collections')->where('seed_generals.type_id', 20)->latest();
    }

}
