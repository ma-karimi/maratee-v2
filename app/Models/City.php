<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="City",
 *            required={"name_en","province_id"}
 **/
class City extends BaseModel
{

    public static $rules = [
        'province_id' => 'required|exists:provinces,id',
        'name_en' => 'required|string',
        'name_fa' => 'string',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';
    protected $hidden = ['created_at', 'updated_at'];


    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

}
