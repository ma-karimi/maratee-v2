<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            name="Chromosome",
 *            required={"n_no", "herbarium_id"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="n_no", type="integer"),
 * 			@SWG\Property(name="2n_no", type="integer"),
 * 			@SWG\Property(name="notes", type="array"),
 * 			@SWG\Property(name="herbarium_id", type="integer"),
 * 			@SWG\Property(name="cryo_bank_id", type="integer"),
 * 			@SWG\Property(name="article_id", type="integer"),
 * 			@SWG\Property(name="location_id", type="integer"),
 * 			@SWG\Property(name="description", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/

class Chromosome extends BaseModel
{



    public static $rules = [
        'herbarium_id' => 'required|exists:herbariums,id',
        'cryo_bank_id' => 'required|exists:cryo_banks,id',
        'article_id' => 'required|exists:articles,id',
        'location_id' => 'required|exists:locations,id',
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
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['2n_no', 'article_id', 'created_at', 'cryo_bank_id', 'deleted_at', 'herbarium_id', 'location_id', 'n_no', 'notes', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['notes' => 'json'];


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

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }


}
