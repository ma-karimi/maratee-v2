<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Relations\{ArticleRelation,LocationRelation};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *            definition="Chromosome",
 *            required={"plant_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="n_no", type="string"),
 * 			@SWG\Property(property="2n_no", type="string"),
 * 			@SWG\Property(property="v_number", type="string"),
 * 			@SWG\Property(property="taxonomy_id", type="integer"),
 * 			@SWG\Property(property="article_id", type="integer"),
 * 			@SWG\Property(property="general_class_id", type="integer"),
 * 			@SWG\Property(property="location_id", type="integer"),
 * 			@SWG\Property(property="description", type="string"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string")
 *        )
 **/
class Chromosome extends BaseModel implements HasMedia
{

    use ArticleRelation, LocationRelation, HasMediaTrait;

    public static $rules = [
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'article_id' => 'exists:articles,id',
        'location_id' => 'exists:locations,id',
        'general_class_id' => 'required|exists:generals,id',
        'n_no' => 'string',
        '2n_no' => 'string',
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
