<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visits';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['archive_no', 'archives_types', 'created_at', 'date', 'deleted_at', 'description', 'media_id', 'paleontology_id', 'peoples', 'purpose', 'updated_at', 'user_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'json',
        'purpose' => 'json'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    public function media()
    {
        return $this->belongsTo(Medias::class, 'media_id');
    }

    public function paleontology()
    {
        return $this->belongsTo(Paleontologies::class, 'paleontology_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

}
