<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="Chromosome",
 *            required={"taxonomy_id"},
 **/
class Chromosome extends BaseModel
{

    use ArticleRelation;

    public static $rules = [
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'general_class_id' => 'required|exists:generals,id',
        'n_no' => 'integer',
        'n2_no' => 'integer',
        'v_number' => 'string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chromosomes';



    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
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
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function generalClass(): BelongsTo
    {
        return $this->belongsTo(General::class)->whereType('class');
    }

}
