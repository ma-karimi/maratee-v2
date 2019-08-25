<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Exchange",
 *            required={"send_herbarium_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="send_herbarium_id", type="integer"),
 * 			@SWG\Property(property="send_date", type="string"),
 * 			@SWG\Property(property="receive_date", type="string"),
 * 			@SWG\Property(property="description", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="receive_herbarium_id", type="integer"),
 * 			@SWG\Property(property="send_sheet_no", type="integer"),
 * 			@SWG\Property(property="send_sample_no", type="integer"),
 * 			@SWG\Property(property="receive_sheet_no", type="integer"),
 * 			@SWG\Property(property="receive_sample_no", type="integer"),
 * 			@SWG\Property(property="send_paleontology_id", type="integer"),
 * 			@SWG\Property(property="receive_paleontology_id", type="integer"),
 * 			@SWG\Property(property="send_type", type="string"),
 * 			@SWG\Property(property="receive_type", type="string"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class Exchange extends BaseModel
{

    public static $linguistically=['description'=>false];

    public static $rules = [
        'send_department_id' => 'required|exists:departments,id',
        'receive_department_id' => 'required|exists:departments,id',
        'send_id' => 'required|integer',
        'receive_id' => 'integer',
        'exchange_type' => 'required|string',
        'send_date' => 'datetime',
        'receive_date' => 'datetime',
        'send_sheet_no' => 'integer',
        'send_sample_no' => 'integer',
        'receive_sheet_no' => 'integer',
        'receive_sample_no' => 'integer',
        'send_type' => 'string',
        'receive_type' => 'string',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exchanges';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['description' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'receive_date', 'send_date', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function sendHerbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class, 'send_herbarium_id');
    }

    /**
     * @return BelongsTo
     */
    public function receiveHerbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class, 'receive_herbarium_id');
    }

    /**
     * @return BelongsTo
     */
    public function sendPaleontology(): BelongsTo
    {
        return $this->belongsTo(Paleontology::class, 'send_paleontology_id');
    }

    /**
     * @return BelongsTo
     */
    public function receivePaleontology(): BelongsTo
    {
        return $this->belongsTo(Paleontology::class, 'receive_paleontology_id');
    }


    /**
     * @return HasMany
     */
    public function paleontologyMedias(): HasMany
    {
        return $this->hasMany(PaleontologyMedia::class)->latest();
    }
}
