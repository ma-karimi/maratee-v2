<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'level', 'description', 'created_at', 'updated_at'];
    protected $casts =
        [
            'name' => 'json',
            'description' => 'json',
            'hierarchy' => 'json',
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission');
    }
}
