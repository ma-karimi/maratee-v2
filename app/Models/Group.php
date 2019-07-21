<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $name
 * @property mixed $owner_crud
 * @property mixed $same_level_crud
 * @property mixed $upper_level_crud
 * @property mixed $lower_level_crud
 * @property string $created_at
 * @property string $updated_at
 * @property Permission[] $permissions
 */
class Group extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'owner_crud', 'same_level_crud', 'upper_level_crud', 'lower_level_crud', 'created_at', 'updated_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission');
    }
}
