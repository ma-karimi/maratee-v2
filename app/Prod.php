<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $organization_id
 * @property mixed $name
 * @property mixed $description
 * @property string $registration_status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Organization $organization
 * @property Media[] $medias
 * @property Medical[] $medicals
 */
class Prod extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = ['organization_id', 'name', 'description', 'registration_status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medias()
    {
        return $this->hasMany('App\Models\Media');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicals()
    {
        return $this->hasMany('App\Models\Medical');
    }
}
