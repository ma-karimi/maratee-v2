<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\LifeFormScope;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="LifeForm",
 *      required={"name", "type"}
 * )
 */
class LifeForm extends BaseModel
{
    use LifeFormScope;
    public static $linguistically = ['name' => true];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'life_forms';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json'];

    public function leafHerbariums(): HasMany
    {
        return $this->hasMany(Plant::class)->where('type', 'leaf');
    }

    public function herbaceousHerbariums(): HasMany
    {
        return $this->hasMany(Plant::class)->where('type', 'herbaceous');
    }

    public function woodenHerbariums(): HasMany
    {
        return $this->hasMany(Plant::class)->where('type', 'wooden');
    }

    public function cycleHerbariums(): HasMany
    {
        return $this->hasMany(Plant::class)->where('type', 'cycle');
    }
}
