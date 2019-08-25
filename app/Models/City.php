<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="City",
 *            required={"name","province_id"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="array",
	 *     @SWG\Items(type="string")),
 * 			@SWG\Property(property="province_id", type="integer"),
 * 			@SWG\Property(property="code", type="string"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class City extends BaseModel
{

    public static $linguistically=['name'=>true];
    public static $rules = [
        'province_id' => 'required|exists:provinces,id',
        'code' => 'string',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

}
