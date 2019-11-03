<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Organization",
 *      required={"name","phone"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="domestic_code",
 *          description="domestic_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="international_code",
 *          description="international_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_herbarium",
 *          description="is_herbarium",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="name_en",
 *          description="name",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="name_fa",
 *          description="name",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="fax",
 *          description="fax",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="website",
 *          description="website",
 *          type="string"
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
class Organization extends BaseModel
{
    public static $rules = [
        'domestic_code' => 'string',
        'international_code' => 'string',
        'is_herbarium' => 'integer',
        'phone' => 'required|string',
        'name_en' => 'required|string',
        'email' => 'email',
        'website' => 'string'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

    /**
     * @return HasMany
     */
    public function entryHubs(): HasMany
    {
        return $this->hasMany(EntryHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class)->latest();
    }
}
