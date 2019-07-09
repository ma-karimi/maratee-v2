<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class Action extends BaseModel
{
    const ACTION_ID = 'action_id';


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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json', 'description' => 'json'];



    public function actionHubs()
    {
        return $this->hasMany(ActionHub::class, self::ACTION_ID)->latest();
    }

    public function articleHubs()
    {
        return $this->hasMany(ArticleHub::class, self::ACTION_ID)->latest();
    }
    public function cryoBankActions()
    {
        return $this->hasMany(CryoBankAction::class, self::ACTION_ID)->latest();
    }
}
