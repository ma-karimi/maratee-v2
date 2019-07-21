<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Table extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['department_id', 'table_name', 'ownership', 'create', 'read', 'write', 'delete', 'copy', 'created_at', 'updated_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

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
