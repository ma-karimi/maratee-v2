<?php

namespace App\Models;

use App\Models\Accessor\CryoBankAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ActionRelation;
use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="CryoBank",
 *            required={"taxonomy_id", "protection_id"},
 *
 */
class CryoBank extends BaseModel
{
    use ActionRelation, ArticleRelation, CryoBankAccessor;

    public const TYPE_SAMPLE = [
        1 => 'seed', 2 => 'shoot', 3 => 'cell'
    ];
    public const SAMPLE = [
        1 => 'S', 2 => 'SH', 3 => 'C'
    ];
    public static $rules = [
        'protection_id' => 'required|exists:protections,id',
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'sample_type_id' => 'required|in:1,2,3',
        'rack' => 'required|string',
        'repeat' => 'nullable|string',
        'tank' => 'required|string',
        'cell' => 'required|string',
        'row' => 'required|string',
        'proposal_name' => 'nullable|string',
        'treatment_id' => 'nullable|exists:treatments,id',
        'treatment_values' => 'nullable|string',
        'year' => 'required|integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cryo_banks';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $appends = ['sample_type', 'sample', 'genotype_code'];

    /**
     * @return BelongsTo
     */
    public function protection(): BelongsTo
    {
        return $this->belongsTo(Protection::class);
    }

    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
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
    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }
}
