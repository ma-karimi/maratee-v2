<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;


class Transition extends BaseModel
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['table_id', 'creator_id', 'requester_id', 'changer_id', 'responser_id', 'table_name', 'field_name', 'status', 'crud_type', 'request_date', 'change_date', 'response_date', 'request_status', 'previous_value', 'next_value', 'description', 'created_at', 'updated_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
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
        return $this->belongsTo('App\Models\Table');
    }
}
