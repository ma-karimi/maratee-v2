<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *            definition="City",
 *            required={"name_en","province_id"},
 * 			@SWG\Property(property="id", type="integer"),
 *      @SWG\Property(property="name_en", type="string"),
 *      @SWG\Property(property="name_fa", type="string"),
 *      @SWG\Property(property="province_id", type="integer"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
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


    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

}
