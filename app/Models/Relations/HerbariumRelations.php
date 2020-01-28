<?php


namespace App\Models\Relations;


use App\Models\ActionHub;
use App\Models\General;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Plant;
use App\Models\Taxonomy;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HerbariumRelations
{
    public function plant()
    {
        return $this->belongsTo(Plant::class, 'taxonomy_id', 'taxonomy_id');
    }

    public function determine()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 1);
    }

    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }

    public function research()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 3);
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @return MorphMany
     */
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable')
            ->whereNull('deleted_at');
    }


    public function generalPhytogeography(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_phytogeography_id')->whereType('phytogeography');
    }


    public function generalSubstrate()
    {
        return $this->belongsTo(General::class, 'general_substrate_id')->whereIn('type', ['diatom', 'moss', 'lichen']);
    }


    public function generalHabitat(): BelongsTo
    {
        return $this->belongsTo(General::class, 'general_habitat_id')->whereType('habitat');
    }

}
