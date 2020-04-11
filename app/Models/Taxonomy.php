<?php

namespace App\Models;

use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable;

/**
 * @SWG\Definition(
 *      definition="Taxonomy",
 *      required={"family_id"}
 * )
 */
class Taxonomy extends BaseModel
{

    use AuditTrait, Auditable;
    public static $rules = [
        'family_id' => 'required|exists:generals,id',
        'genus_id' => 'nullable|exists:generals,id',
        'species_id' => 'nullable|exists:generals,id',
        'variety_id' => 'nullable|exists:generals,id',
        'subspecies_id' => 'nullable|exists:generals,id',
        'name' => 'nullable|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'taxonomies';
    protected $with = ['family', 'genus', 'subspecies.authors', 'species.authors', 'variety.authors', 'audits'];
    protected $appends = ['authors', 'scientific_name', 'scientific', 'last_audit'];

    public function getAuthorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('species') && !empty($this->species) && $this->species->authors->count()) {
            $authors = $this->species->authors->implode('name', ' & ');
        }
        if ($this->relationLoaded('subspecies') && !empty($this->subspecies) && $this->subspecies->authors->count()) {
            $and = !empty($authors) ? ' & ' : null;
            $authors .= $and . $this->subspecies->authors->implode('name', ' & ');
        }
        if ($this->relationLoaded('variety') && !empty($this->variety) && $this->variety->authors->count()) {
            $and = !empty($authors) ? ' & ' : null;
            $authors .= $and . $this->variety->authors->implode('name', ' & ');
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
        if ($this->relationLoaded('subspecies') && !empty($this->subspecies)) {
            $and = !empty($name) ? ' ' : null;
            $name .= $and . $this->subspecies->name;
        }
        if ($this->relationLoaded('variety') && !empty($this->variety)) {
            $and = !empty($name) ? ' ' : null;
            $name .= $and . $this->variety->name;
        }

        return $name;
    }

    public function getScientificAttribute()
    {
        return $this->scientific_name . ' ' . $this->authors;
    }

    /**
     * @return HasMany
     */
    public function flora(): HasMany
    {
        return $this->hasMany(Plant::class);
    }

    /**
     * @return HasMany
     */
    public function herbarium(): HasMany
    {
        return $this->hasMany(Herbarium::class)->where('is_flowering', 1);
    }

    /**
     * @return HasMany
     */
    public function medicinalPlant(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class);
    }

    /**
     * @return HasMany
     */
    public function seedCollection(): HasMany
    {
        return $this->hasMany(SeedCollection::class);
    }

    /**
     * @return HasMany
     */
    public function botanical(): HasMany
    {
        return $this->hasMany(Botanical::class);
    }

    /**
     * @return HasMany
     */
    public function chromosome(): HasMany
    {
        return $this->hasMany(Chromosome::class);
    }

    /**
     * @return HasMany
     */
    public function cryobank(): HasMany
    {
        return $this->hasMany(Chromosome::class);
    }

    /**
     * @return BelongsTo
     */
    public function genus(): BelongsTo
    {
        return $this->belongsTo(General::class, 'genus_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(General::class, 'species_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function subspecies(): BelongsTo
    {
        return $this->belongsTo(General::class, 'subspecies_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function variety(): BelongsTo
    {
        return $this->belongsTo(General::class, 'variety_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(General::class, 'family_id')->ofSelect();
    }


}
