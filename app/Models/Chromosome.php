<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *            definition="Chromosome",
 *            required={"n_no", "herbarium_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="n_no", type="integer"),
 * 			@SWG\Property(property="2n_no", type="integer"),
 * 			@SWG\Property(property="notes", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="herbarium_id", type="integer"),
 * 			@SWG\Property(property="url", type="string"),
 * 			@SWG\Property(property="cryo_bank_id", type="integer"),
 * 			@SWG\Property(property="article_id", type="integer"),
 * 			@SWG\Property(property="location_id", type="integer"),
 * 			@SWG\Property(property="general_class_id", type="integer"),
 * 			@SWG\Property(property="description", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/

class Chromosome extends BaseModel
{

    public static $linguistically=['notes'=>false];

    public static $rules = [
        'herbarium_id' => 'required|exists:herbariums,id',
        'cryo_bank_id' => 'required|exists:cryo_banks,id',
        'general_class_id' => 'required|exists:generals,id',
        'n_no' => 'required|integer',
        '2n_no' => 'integer',
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
    protected $casts = ['notes' => 'json'];


    /**
     * @return BelongsTo
     */
    public function cryoBank(): BelongsTo
    {
        return $this->belongsTo(CryoBank::class);
    }

    /**
     * @return BelongsTo
     */
    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
    }


    public function articles(): MorphToMany
    {
        return $this->morphToMany(Article::class,
            'articleable','article_hubs')
            ->whereNull('article_hubs.deleted_at')
            ->withTimestamps();
    }


    /**
     * @return MorphToMany
     */
    public function locations(): MorphToMany
    {
        return $this->morphToMany(LocationHub::class, 'locationable','location_hubs')
            ->whereNull('location_hubs.deleted_at')
            ->withTimestamps();
    }
}
