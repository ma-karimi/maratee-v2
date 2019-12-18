<?php


namespace App\Models\Relations;


use App\Models\{ActionHub, Article, General, Location, MedicinalLocationConstituent, MedicinalPlantType, Method};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait MedicinalLocationRelations
{


    public function determine()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 1);
    }

    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }


    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function location()
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


    public function treatment()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'treatment_id'
        )->where('type_id', array_search('treatment', MedicinalPlantType::TYPE));
    }


    public function distillation()
    {
        return $this->belongsTo(Method::class, 'method_distillation_id'
        )->where('type_id', 1);
    }

    public function extraction()
    {
        return $this->belongsTo(Method::class, 'method_extraction_id'
        )->where('type_id', 2);
    }

    public function analyse()
    {
        return $this->belongsTo(Method::class, 'method_analyse_id'
        )->where('type_id', 3);
    }

    public function secondaryMetabolites()
    {
        return $this->morphedByMany(MedicinalPlantType::class, 'hub', 'medicinal_location_hubs'
        )->where('medicinal_plant_types.type_id', array_search('secondary_metabolite', MedicinalPlantType::TYPE))->withTimestamps()->whereNull('medicinal_location_hubs.deleted_at');
    }


    public function phenology()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'phenology_id'
        )->where('type_id', array_search('stage_of_phenology', MedicinalPlantType::TYPE));
    }

}
