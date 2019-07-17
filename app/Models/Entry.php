<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            name="Entry",
 *            required={"type"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="type", type="array"),
 * 			@SWG\Property(name="description", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
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


    /**
     * @return HasMany
     */
    public function entryHubs(): HasMany
    {
        return $this->hasMany(EntryHub::class)->latest();
    }

}
