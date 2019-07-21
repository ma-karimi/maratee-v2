<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @SWG\Definition(
 *      definition="Table",
 *      required={"table_name","department_id","ownership","create","read","write","delete","copy"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="table_name",
 *          description="table_name",
 *          type="string",
 *     @SWG\Items(type="string"),
 *          format="string"
 *      ),
 *      @SWG\Property(
 *          property="department_id",
 *          description="department_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="ownership",
 *          description="ownership",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="create",
 *          description="create",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="read",
 *          description="read",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="write",
 *          description="write",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="delete",
 *          description="delete",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="copy",
 *          description="copy",
 *          type="integer",
 *          format="int32"
 *      ),
 * )
 */
class Table extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['department_id', 'table_name', 'ownership', 'create', 'read', 'write', 'delete', 'copy', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transitions()
    {
        return $this->hasMany('App\Models\Transition');
    }
}
