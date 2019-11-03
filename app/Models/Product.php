<?php

namespace App\Models;

use App\Models\Accessor\ProductAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Product",
 *      required={"name","organization_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
 *          property="consumption",
 *          description="consumption",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="active_compounds",
 *          description="active_compounds",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="manufacturer",
 *          description="manufacturer",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="registration_status",
 *          description="registration_status",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="components",
 *          description="components",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="organization_id",
 *          description="organization_id",
 *          type="integer",
 *          format="int32"
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
class Product extends BaseModel implements HasMedia
{
    use ProductAccessor,HasMediaTrait;
    public const STATUS = [1 => 'unregistered', 2 => 'registered'];
    public static $linguistically = ['name' => true];
    public static $rules = [
        'organization_id' => 'required|exists:organizations,id',
        'registration_status' => 'integer|required',
        'consumption' => 'string',
        'active_compounds' => 'string',
        'manufacturer' => 'string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
    ];

    /**
     * @return BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

}
