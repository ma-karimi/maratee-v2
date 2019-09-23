<?php

namespace App\Models;

use App\Models\Accessor\CryoBankAccessor;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\ActionRelation;
use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *            definition="CryoBank",
 *            required={"genotype_code", "protection_id", "plant_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="genotype_code", type="string"),
 * 			@SWG\Property(property="protection_id", type="integer"),
 * 			@SWG\Property(property="sample_type", type="integer"),
 * 			@SWG\Property(property="repeat", type="integer"),
 * 			@SWG\Property(property="treatment_values", type="number"),
 * 			@SWG\Property(property="tank", type="integer"),
 * 			@SWG\Property(property="row", type="integer"),
 * 			@SWG\Property(property="rack", type="string"),
 * 			@SWG\Property(property="cell", type="integer"),
 * 			@SWG\Property(property="plant_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class CryoBank extends BaseModel implements HasMedia
{
    use ActionRelation, ArticleRelation,HasMediaTrait, CryoBankAccessor;

    public const TYPE_SAMPLE = [
        ['id'=>'0', 'name'=>'unknown'],
        ['id'=>'1', 'name'=>'seed'],
        ['id'=>'2', 'name'=>'shoot'],
        ['id'=>'3', 'name'=>'cell'],
    ];
    public static $rules = [
        'genotype_code' => 'required|string',
        'protection_id' => 'required|exists:protections,id',
        'plant_id' => 'required|exists:plants,id',
        'sample_type' => 'string',
        'rack' => 'string',
        'repeat' => 'integer',
        'tank' => 'integer',
        'cell' => 'integer',
        'row' => 'integer',
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

    protected $appends = ['sample_type'];
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
    public function plant(): BelongsTo
    {
        return $this->belongsTo(PlantHerbarium::class);
    }

    /**
     * @return BelongsTo
     */
    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }
}
