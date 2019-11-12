<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @SWG\Definition(
 *      definition="Taxonomy",
 *      required={"family_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="genus_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="species_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="subspecies_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="variety_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tip_type_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="family_id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Taxonomy extends BaseModel
{

//
//    public static $rules = [
//        'family_id' => 'required|exists:generals,id',
//        'genus_id' => 'exists:generals,id',
//        'species_id' => 'exists:generals,id',
//        'variety_id' => 'exists:generals,id',
//        'subspecies_id' => 'exists:generals,id',
//        'name'=>'string'
//    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'taxonomies';

    protected $with = ['scientific', 'authors', 'family', 'genus', 'subspecies.authors', 'species.authors', 'variety.authors'];

    /**
     * @return HasOne
     */
    public function scientific(): HasOne
    {
        return $this->hasOne(ScientificView::class, 'taxonomy_id');
    }
    /**
     * @return HasOne
     */
    public function authors(): HasOne
    {
        return $this->hasOne(TaxonomyAuthorView::class, 'taxonomy_id');
    }

    /**
     * @return HasMany
     */
    public function plantHerbariums(): HasMany
    {
        return $this->hasMany(Plant::class);
    }
    /**
     * @return HasMany
     */
    public function seedCollection(): HasMany
    {
        return $this->hasMany(SeedCollection::class);
    }

    /**
     * @return BelongsTo
     */
    public function genus(): BelongsTo
    {
        return $this->belongsTo(General::class, 'genus_id');
    }

    /**
     * @return BelongsTo
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(General::class, 'species_id');
    }

    /**
     * @return BelongsTo
     */
    public function subspecies(): BelongsTo
    {
        return $this->belongsTo(General::class, 'subspecies_id');
    }

    /**
     * @return BelongsTo
     */
    public function tipType(): BelongsTo
    {
        return $this->belongsTo(General::class, 'tip_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function variety(): BelongsTo
    {
        return $this->belongsTo(General::class, 'variety_id');
    }

    /**
     * @return BelongsTo
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(General::class, 'family_id');
    }


}
