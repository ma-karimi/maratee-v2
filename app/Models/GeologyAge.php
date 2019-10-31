<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *            definition="GeologyAge",
 *            required={"name", "type", "type"}
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
