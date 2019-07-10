<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    /**
     * @return HasMany
     */
    public function actionHubs(): HasMany
    {
        return $this->hasMany(ActionHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function articleHubs(): HasMany
    {
        return $this->hasMany(ArticleHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function cryoBankActions(): HasMany
    {
        return $this->hasMany(CryoBankAction::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function paleontologyActions(): HasMany
    {
        return $this->hasMany(PaleontologyActions::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedHubs(): HasMany
    {
        return $this->hasMany(SeedHub::class)->latest();
    }
}
