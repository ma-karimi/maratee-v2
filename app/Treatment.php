<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $paleontology_id
 * @property mixed $name
 * @property mixed $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Paleontology $paleontology
 */
class Treatment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['paleontology_id', 'name', 'description', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paleontology()
    {
        return $this->belongsTo('App\Models\Paleontology');
    }
}
