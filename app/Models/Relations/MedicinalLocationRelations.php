<?php


namespace App\Models\Relations;


use App\Models\{ActionHub, Article, Location, MedicinalLocationConstituent, MedicinalPlant, MedicinalPlantType, Method};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait MedicinalLocationRelations
{

    /**
     * @return BelongsTo
     */
    public function medicinal(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlant::class, 'medicinal_plant_id');
    }

    /**
     * @return mixed
     */
    public function determine()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 1);
    }

    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }


    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return HasMany
     */
    public function constituents(): HasMany
    {
        return $this->hasMany(MedicinalLocationConstituent::class);
    }


    /**
     * @return BelongsTo
     */
    public function treatment(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlantType::class, 'treatment_id'
        )->where('type_id', array_search('treatment', MedicinalPlantType::TYPE));
    }


    /**
     * @return BelongsTo
     */
    public function distillation(): BelongsTo
    {
        return $this->belongsTo(Method::class, 'method_distillation_id'
        )->where('type_id', 1);
    }

    /**
     * @return BelongsTo
     */
    public function extraction(): BelongsTo
    {
        return $this->belongsTo(Method::class, 'method_extraction_id'
        )->where('type_id', 2);
    }

    /**
     * @return BelongsTo
     */
    public function analyse(): BelongsTo
    {
        return $this->belongsTo(Method::class, 'method_analyse_id'
        )->where('type_id', 3);
    }

    /**
     * @return MorphToMany
     */
    public function secondaryMetabolites(): MorphToMany
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_location_hubs'
        )->where('medicinal_plant_types.type_id', array_search('secondary_metabolite', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_location_hubs.deleted_at');
    }


    /**
     * @return BelongsTo
     */
    public function phenology(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlantType::class, 'phenology_id'
        )->where('type_id', array_search('stage_of_phenology', MedicinalPlantType::TYPE));
    }

}
