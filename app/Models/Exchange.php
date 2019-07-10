<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PaleontologyMedia;

class Exchange extends BaseModel
{


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
        return $this->hasMany(PaleontologyMedia::class);
    }
}
