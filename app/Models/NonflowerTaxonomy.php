<?php

namespace App\Models;

use App\Models\Accessor\AuthorTraits;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Contracts\GeneralTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jedrzej\Searchable\Constraint;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @SWG\Definition(
 *      definition="NonflowerTaxonomy",
 *      required={"family_id"}
 * )
 */
class NonflowerTaxonomy extends BaseModel implements AuditableContract
{

    use AuditTrait, Auditable,AuthorTraits;

    public static $rules = [
        'family_id' => 'required|exists:nonflower_generals,id',
        'genus_id' => 'nullable|exists:nonflower_generals,id',
        'species_id' => 'nullable|exists:nonflower_generals,id',
        'variety_id' => 'nullable|exists:nonflower_generals,id',
        'subspecies_id' => 'nullable|exists:nonflower_generals,id',
        'name' => 'nullable|string',
        'phylum' => 'required|string'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nonflower_taxonomies';
    protected $with = ['family', 'genus', 'subspecies.authors', 'species.authors', 'variety.authors', 'audits'];
    protected $appends = ['authors', 'scientific_name', 'scientific', 'last_audit'];

    use GeneralTrait;


    public function getPhylumAttribute($value)
    {
        return ['id' => $value, 'name' => $value];
    }

    public function getAuthorsAttribute()
    {
        $authors = null;

        if ($this->relationLoaded('species') && !empty($this->species)) {
            $authors = $this->species_authors;
        }
        if ($this->relationLoaded('subspecies') && !empty($this->subspecies)) {
            $and = !empty($authors) ? ' & ' : null;
            $authors .= $and . $this->subspecies_authors;
        }
        if ($this->relationLoaded('variety') && !empty($this->variety)) {
            $and = !empty($authors) ? ' & ' : null;
            $authors .= $and . $this->variety_authors;
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
            $and = !empty($name) ? ' subsp. ' : null;
            $name .= $and . $this->subspecies->name;
        }
        if ($this->relationLoaded('variety') && !empty($this->variety)) {
            $and = !empty($name) ? ' var. ' : null;
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
