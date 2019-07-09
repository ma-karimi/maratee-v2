<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class EntryHub extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entry_hubs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'deleted_at', 'entry_id', 'location_id', 'organization_id', 'updated_at'];




    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function botanical()
    {
        return $this->belongsTo(Botanical::class);
    }

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organizations::class);
    }

}
