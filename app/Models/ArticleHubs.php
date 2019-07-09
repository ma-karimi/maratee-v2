<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class ArticleHubs extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'article_hubs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['action_id', 'article_id', 'created_at', 'cryo_bank_id', 'date', 'deleted_at', 'location_id', 'updated_at', 'user_id'];

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
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    public function article()
    {
        return $this->belongsTo(Articles::class);
    }

    public function action()
    {
        return $this->belongsTo(Actions::class);
    }

    public function cryoBank()
    {
        return $this->belongsTo(CryoBanks::class);
    }

    public function location()
    {
        return $this->belongsTo(Locations::class);
    }
}
