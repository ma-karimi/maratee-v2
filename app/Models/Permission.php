<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Permission",
 *      required={"user_id","department_id","group_id","role_id","requester_id","responser_id","permission_status","request_date","approval_date","expire_date","owner_crud","same_level_crud","upper_level_crud","lower_level_crud"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="department_id",
 *          description="department_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="group_id",
 *          description="group_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="role_id",
 *          description="role_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="requester_id",
 *          description="requester_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="responser_id",
 *          description="responser_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="permission_status",
 *          description="permission_status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="request_date",
 *          description="request_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="approval_date",
 *          description="approval_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="expire_date",
 *          description="expire_date",
 *          type="string",
 *          format="date-time"
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
class Permission extends BaseModel
{
    public static $linguistically=['owner_crud'=>true,'same_level_crud'=>true,'upper_level_crud'=>true,'lower_level_crud'=>true];
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'department_id', 'group_id', 'role_id', 'requester_id', 'responser_id', 'permission_status', 'request_date', 'approval_date', 'expire_date', 'owner_crud', 'same_level_crud', 'upper_level_crud', 'lower_level_crud', 'created_at', 'updated_at'];

   protected $casts =
       [
         'owner_crud'=>'json',
         'same_level_crud'=>'json',
         'upper_level_crud'=>'json',
         'lower_level_crud'=>'json',
       ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRequester()
    {
        return $this->belongsTo('App\Models\User', 'requester_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userResponser()
    {
        return $this->belongsTo('App\Models\User', 'responser_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
