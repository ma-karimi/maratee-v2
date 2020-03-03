<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *      definition="NonflowerTaxonomy",
 *      required={"family_id"}
 * )
 */
class NonflowerTaxonomy extends BaseModel
{


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
    protected $table = 'nonflower_taxonomies';
    protected $with = ['family', 'genus', 'subspecies.authors', 'species.authors', 'variety.authors'];
    protected $appends = ['authors', 'scientific_name'];

    public function getTypeAttribute()
    {
        return Arr::get(self::TYPE, $this->type_id);
    }

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

    /**
     * @return HasMany
     */
    public function nonflower(): HasMany
    {
        return $this->hasMany(Nonflower::class);
    }


    /**
     * @return BelongsTo
     */
    public function genus(): BelongsTo
    {
        return $this->belongsTo(NonflowerGeneral::class, 'genus_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(NonflowerGeneral::class, 'species_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function subspecies(): BelongsTo
    {
        return $this->belongsTo(NonflowerGeneral::class, 'subspecies_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function variety(): BelongsTo
    {
        return $this->belongsTo(NonflowerGeneral::class, 'variety_id')->ofSelect();
    }

    /**
     * @return BelongsTo
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(NonflowerGeneral::class, 'family_id')->ofSelect();
    }


}
