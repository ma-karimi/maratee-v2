<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Relations\{ArticleRelation,LocationRelation};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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
 * 			@SWG\Property(property="plant_id", type="integer"),
 * 			@SWG\Property(property="general_class_id", type="integer"),
 * 			@SWG\Property(property="description", type="array",
 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Chromosome extends BaseModel
{

    use ArticleRelation, LocationRelation, HasMediaTrait;
    public static $linguistically = ['description' => false];

    public static $rules = [
        'plant_id' => 'required|exists:plants,id',
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['description' => 'json'];

    /**
     * @return BelongsTo
     */
    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class);
    }

    /**
     * @return BelongsTo
     */
    public function generalClass(): BelongsTo
    {
        return $this->belongsTo(General::class)->whereType('class');
    }

}
