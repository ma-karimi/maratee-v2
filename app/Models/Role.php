<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $name
 * @property int $level
 * @property mixed $description
 * @property string $created_at
 * @property string $updated_at
 * @property Permission[] $permissions
 */
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'level', 'description', 'created_at', 'updated_at'];

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
