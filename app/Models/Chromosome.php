<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Chromosome extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chromosomes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['2n_no', 'article_id', 'created_at', 'cryo_bank_id', 'deleted_at', 'herbarium_id', 'location_id', 'n_no', 'notes', 'updated_at'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['notes' => 'json'];


    public function herbarium()
    {
        return $this->belongsTo(Herbarium::class);
    }

    public function cryoBank()
    {
        return $this->belongsTo(CryoBank::class, 'cryo_bank_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }


}
