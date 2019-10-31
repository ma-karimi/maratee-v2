<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *            definition="GeologyAge",
 *            required={"name", "type", "type"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="string"),
 * 			@SWG\Property(property="type_id", type="string"),
 * 			@SWG\Property(property="created_at", type="string"),
 * 			@SWG\Property(property="updated_at", type="string"),
 *        )
 **/
class GeologyAge extends BaseModel
{

    public $types = [
        1 => 'Era',
        2 => 'Period',
        3 => 'Epoch',
        4 => 'Stage',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geology_ages';

    protected $appends = ['type'];

    /**
     * @return HasMany
     */
    public function paleontologies()
    {
        return $this->hasMany(Paleontology::class)->latest();
    }

    public function getTypeAttribute()
    {
        return Arr::get($this->types, $this->type_id);
    }
}
