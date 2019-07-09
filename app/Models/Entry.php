<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Entry extends BaseModel
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entries';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'type', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['type' => 'json', 'description' => 'json'];


    public function entryHubs()
    {
        return $this->hasMany(EntryHub::class, 'entry_id')->latest();
    }

}
