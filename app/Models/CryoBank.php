<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            name="CryoBank",
 *            required={"voucher_number", "geotype_code", "protection_id", "herbarium_id"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="voucher_number", type="string"),
 * 			@SWG\Property(name="geotype_code", type="string"),
 * 			@SWG\Property(name="protection_id", type="integer"),
 * 			@SWG\Property(name="entry_date", type="string"),
 * 			@SWG\Property(name="sample_type", type="string"),
 * 			@SWG\Property(name="treatment", type="array"),
 * 			@SWG\Property(name="repetition", type="integer"),
 * 			@SWG\Property(name="tank_type", type="array"),
 * 			@SWG\Property(name="layering_no", type="integer"),
 * 			@SWG\Property(name="tank_no", type="integer"),
 * 			@SWG\Property(name="row_no", type="integer"),
 * 			@SWG\Property(name="rack_no", type="string"),
 * 			@SWG\Property(name="cell_no", type="integer"),
 * 			@SWG\Property(name="herbarium_id", type="integer"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class CryoBank extends BaseModel
{


    public static $rules = [
        'voucher_number' => 'required|string',
        'geotype_code' => 'required|string',
        'protection_id' => 'required|exists:protections,id',
        'herbarium_id' => 'required|exists:herbariums,id',
        'entry_date' => 'date',
        'sample_type' => 'string',
        'rack_no' => 'string',
        'repetition' => 'integer',
        'layering_no' => 'integer',
        'tank_no' => 'integer',
        'cell_no' => 'integer',
        'row_no' => 'integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cryo_banks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cell_no', 'created_at', 'deleted_at', 'entry_date', 'geotype_code', 'herbarium_id', 'layering_no', 'protection_id', 'rack_no', 'repetition', 'row_no', 'sample_type', 'tank_no', 'tank_type', 'treatment', 'updated_at', 'voucher_number'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'treatment' => 'json',
        'tank_type' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'entry_date', 'updated_at'];


    /**
     * @return HasMany
     */
    public function articleHubs(): HasMany
    {
        return $this->hasMany(ArticleHub::class)->latest();
    }


    /**
     * @return HasMany
     */
    public function chromosomes(): HasMany
    {
        return $this->hasMany(Chromosome::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function cryoBankActions(): HasMany
    {
        return $this->hasMany(CryoBankAction::class)->latest();
    }


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
    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
    }
}
