<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Group",
 *      required={"name","owner_crud","same_level_crud","upper_level_crud","lower_level_crud"},
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
 *          property="owner_crud",
 *          description="owner_crud",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="same_level_crud",
 *          description="same_level_crud",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="upper_level_crud",
 *          description="upper_level_crud",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="lower_level_crud",
 *          description="lower_level_crud",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 * )
 */
class Group extends BaseModel
{
    public static $linguistically = ['name' => true, 'owner_crud' => true, 'same_level_crud' => true, 'upper_level_crud' => true, 'lower_level_crud' => true, 'description' => true];

    /**
     * @var array
     */
    protected $casts =
        [
            'name' => 'json',
            'description' => 'json',
            'owner_crud' => 'json',
            'same_level_crud' => 'json',
            'upper_level_crud' => 'json',
            'lower_level_crud' => 'json'
        ];
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */

    /**
     * @return HasMany
     */
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission');
    }
}
