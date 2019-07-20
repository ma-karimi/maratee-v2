<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="Province",
 *      required={"name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="country_id",
 *          description="country_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */

class Province extends BaseModel
{

    public static $rules=[
        'country_id' => 'exists:countries,id',
        'name' => 'required'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'provinces';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'created_at', 'deleted_at', 'name', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json'
    ];

    /**
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class)->latest();
    }

}
