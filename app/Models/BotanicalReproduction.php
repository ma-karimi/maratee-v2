<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BotanicalReproduction extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'botanical_reproductions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'deleted_at', 'reproduction_id', 'updated_at'];


    /**
     * @return BelongsTo
     */
    public function botanical(): BelongsTo
    {
        return $this->belongsTo(Botanical::class);
    }

    /**
     * @return BelongsTo
     */
    public function reproduction(): BelongsTo
    {
        return $this->belongsTo(Reproduction::class);
    }

}
