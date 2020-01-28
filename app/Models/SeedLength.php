<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *      definition="SeedLength",
 * )
 */
class SeedLength extends BaseModel
{

    public const TYPES = [1 => 'radical_length', 2 => 'shoot_length', 3 => ' seed_length', 4 => 'seed_width'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];
    protected $appends = ['type'];

    public function getTypeAttribute()
    {
        return Arr::get(self::TYPES, $this->type_id);
    }
}
