<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Actions extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'actions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'description', 'name', 'updated_at'];

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
    protected $casts = ['name' => 'json', 'description' => 'json'];



    public function actions()
    {
        return $this->hasMany(ActionHubs::class, 'action_id')->latest();
    }

    public function articleHubs()
    {
        return $this->hasMany(ArticleHubs::class, 'action_id')->latest();
    }
}
