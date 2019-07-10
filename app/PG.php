<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $region
 * @property mixed $section
 * @property mixed $number
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property BotanicalGardenAction[] $botanicalGardenActions
 * @property BotanicalGardenAction[] $botanicalGardenActions
 */
class PG extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gardens';

    /**
     * @var array
     */
    protected $fillable = ['region', 'section', 'number', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function botanicalGardenActions()
    {
        return $this->hasMany('App\Models\BotanicalGardenAction', 'from_garden_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function botanicalGardenActions()
    {
        return $this->hasMany('App\Models\BotanicalGardenAction', 'to_garden_id');
    }
}
