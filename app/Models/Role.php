<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Role",
 *      required={"name","level","description"},
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
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="level",
 *          description="level",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 * )
 */
class Role extends BaseModel
{
    public static $linguistically = ['name' => true, 'description' => true, 'hierarchy' => true];

    protected $casts =
        [
            'name' => 'json',
            'description' => 'json',
            'hierarchy' => 'json',
        ];

    /**
     * @return HasMany
     */
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission');
    }
}
