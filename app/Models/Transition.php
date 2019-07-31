<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Transition",
 *      required={"table_name","field_name","table_id","status","crud_type","creator_id","requester_id","changer_id","responser_id","request_date","change_date","response_date","request_status","previous_value","next_value","description"},
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
 *          property="field_name",
 *          description="field_name",
 *          type="string",
 *          format="string"
 *      ),
 *      @SWG\Property(
 *          property="table_id",
 *          description="table_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tables_id",
 *          description="tables_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="crud_type",
 *          description="crud_type",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="creator_id",
 *          description="creator_id",
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
 *          property="changer_id",
 *          description="changer_id",
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
 *          property="request_date",
 *          description="request_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="change_date",
 *          description="change_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="response_date",
 *          description="response_date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="request_status",
 *          description="request_status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="previous_value",
 *          description="previous_value",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="next_value",
 *          description="next_value",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
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
class Transition extends Model
{
    public static $linguistically=['previous_value'=>true,'next_value'=>true,'description'=>false];
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    //protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['table_id','tables_id', 'creator_id', 'requester_id', 'changer_id', 'responser_id', 'table_name', 'field_name', 'status', 'crud_type', 'request_date', 'change_date', 'response_date', 'request_status', 'previous_value', 'next_value', 'description', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts =
        [
            'previous_value' => 'json',
            'next_value' => 'json',
            'description' => 'json',
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userChanger()
    {
        return $this->belongsTo('App\Models\User', 'changer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userCreator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
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
    public function table()
    {
        return $this->belongsTo('App\Models\Table','tables_id');
    }
}
