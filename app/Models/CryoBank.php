<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *            definition="CryoBank",
 *            required={"voucher_number", "geotype_code", "protection_id", "herbarium_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="voucher_number", type="string"),
 * 			@SWG\Property(property="geotype_code", type="string"),
 * 			@SWG\Property(property="protection_id", type="integer"),
 * 			@SWG\Property(property="entry_date", type="string"),
 * 			@SWG\Property(property="sample_type", type="string"),
 * 			@SWG\Property(property="repetition", type="integer"),
 * 			@SWG\Property(property="tank_type", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="layering_no", type="integer"),
 * 			@SWG\Property(property="tank_no", type="integer"),
 * 			@SWG\Property(property="row_no", type="integer"),
 * 			@SWG\Property(property="rack_no", type="string"),
 * 			@SWG\Property(property="cell_no", type="integer"),
 * 			@SWG\Property(property="herbarium_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class CryoBank extends BaseModel
{

    public static $linguistically=['tank_type'=>false];
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
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
    public function chromosomes(): HasMany
    {
        return $this->hasMany(Chromosome::class)->latest();
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

    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphToMany(Article::class, 'articleable', 'article_hubs')->withTimestamps();
    }


    /**
     * @return MorphToMany
     */
    public function actions(): MorphToMany
    {
        return $this->morphToMany(Action::class, 'actionable', 'action_hubs')
            ->withTimestamps()
            ->withPivot(['user_id','location_id', 'project_id', 'department_id', 'description', 'date']);
    }

    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphToMany(UserHub::class, 'userable')->withTimestamps();
    }


    /**
     * @return MorphToMany
     */
    public function treatments(): MorphToMany
    {
        return $this->morphToMany(Treatment::class, 'treamentable', 'treatment_hubs')->withTimestamps();
    }
}
