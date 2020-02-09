<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="PaleobotanyTaxonomy",
 *      required={"genus_is", "species_id"}
 * )
 */
class PaleobotanyTaxonomy extends BaseModel
{

    public static $rules = [
        'family_id' => 'nullable|exists:paleobotany_generals,id',
        'genus_id' => 'required|exists:paleobotany_generals,id',
        'species_id' => 'required|exists:paleobotany_generals,id',
        'order_id' => 'nullable|exists:paleobotany_generals,id',
        'infra_specific_id' => 'nullable|exists:paleobotany_generals,id',
        'type_status_id' => 'nullable|exists:paleobotany_generals,id',
        'samples' => 'nullable|array',
        'samples.*' => 'nullable|exists:paleobotany_generals,id',
        'divisions' => 'nullable|array',
        'divisions.*.id' => 'nullable|exists:paleobotany_generals,id',
        'divisions.*.value' => 'nullable|string',
        'name' => 'nullable|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $with = ['family', 'genus', 'species.authors', 'order', 'typeStatus', 'samples', 'divisions', 'infraSpecific'];
    protected $appends = ['authors', 'scientific_name', 'sample'];

    public function getAuthorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('genus') && !empty($this->genus) && $this->genus->authors->count()) {
            $authors = $this->genus->authors->implode('name', ' & ');
        }
        if ($this->relationLoaded('species') && !empty($this->species) && $this->species->authors->count()) {
            $and = !empty($authors) ? ' & ' : null;
            $authors .= $and . $this->species->authors->implode('name', ' & ');
        }

        return $authors;
    }

    public function getScientificNameAttribute()
    {
        $name = null;

        if ($this->relationLoaded('genus') && !empty($this->genus)) {
            $name = $this->genus->name;
        }
        if ($this->relationLoaded('species') && !empty($this->species)) {
            $and = !empty($name) ? ' ' : null;
            $name .= $and . $this->species->name;
        }

        return $name;
    }


    /**
     * @return HasMany
     */
    public function paleobotanies(): HasMany
    {
        return $this->hasMany(Paleontology::class, 'taxonomy_id');
    }

    /**
     * @return BelongsTo
     */
    public function genus(): BelongsTo
    {
        return $this->belongsTo(PaleobotanyGeneral::class, 'genus_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(PaleobotanyGeneral::class, 'family_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(PaleobotanyGeneral::class, 'species_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function infraSpecific(): BelongsTo
    {
        return $this->belongsTo(PaleobotanyGeneral::class, 'infra_specific_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function typeStatus(): BelongsTo
    {
        return $this->belongsTo(PaleobotanyGeneral::class, 'type_status_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(PaleobotanyGeneral::class, 'order_id')->ofSelect();
    }


    public function divisions(): MorphToMany
    {
        return $this->morphToMany(PaleobotanyGeneral::class, 'modelable', 'paleobotany_general_hubs')
            ->withPivot('value')
            ->withTimestamps()
            ->whereNull('paleobotany_general_hubs.deleted_at')
            ->where('paleobotany_generals.type', 'division');
    }

    public function samples(): MorphToMany
    {
        return $this->morphToMany(PaleobotanyGeneral::class, 'modelable', 'paleobotany_general_hubs')
            ->withTimestamps()
            ->whereNull('paleobotany_general_hubs.deleted_at')
            ->where('paleobotany_generals.type', 'sample');
    }


    public function getSampleAttribute()
    {
        $item = null;

        if ($this->relationLoaded('samples') && $this->samples->count()) {
            $item = $this->samples->implode('name', ' & ');
        }

        return $item;
    }

}
