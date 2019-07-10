<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $name
 * @property mixed $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property SeedChemical[] $seedChemicals
 */
class Art extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'chemicals';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedChemicals()
    {
        return $this->hasMany('App\Models\SeedChemical');
    }
}
