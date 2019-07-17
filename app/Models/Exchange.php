<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            name="Exchange",
 *            required={"send_herbarium_id"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="send_herbarium_id", type="integer"),
 * 			@SWG\Property(name="send_date", type="string"),
 * 			@SWG\Property(name="receive_date", type="string"),
 * 			@SWG\Property(name="description", type="array"),
 * 			@SWG\Property(name="receive_herbarium_id", type="integer"),
 * 			@SWG\Property(name="send_sheet_no", type="integer"),
 * 			@SWG\Property(name="send_sample_no", type="integer"),
 * 			@SWG\Property(name="receive_sheet_no", type="integer"),
 * 			@SWG\Property(name="receive_sample_no", type="integer"),
 * 			@SWG\Property(name="send_paleontology_id", type="integer"),
 * 			@SWG\Property(name="receive_paleontology_id", type="integer"),
 * 			@SWG\Property(name="send_type", type="string"),
 * 			@SWG\Property(name="receive_type", type="string"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class Exchange extends BaseModel
{


    public static $rules = [
        'send_herbarium_id' => 'required|exists:herbariums,id',
        'send_paleontology_id' => 'required|exists:paleontologies,id',
        'receive_herbarium_id' => 'required|exists:herbariums,id',
        'receive_paleontology_id' => 'required|exists:paleontologies,id',
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
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'receive_date', 'receive_herbarium_id', 'receive_paleontology_id', 'receive_sample_no', 'receive_sheet_no', 'receive_type', 'send_date', 'send_herbarium_id', 'send_paleontology_id', 'send_sample_no', 'send_sheet_no', 'send_type', 'updated_at'];


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
    public function recieverHerbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class, 'receive_herbarium_id');
    }

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
