<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['birthday', 'created_at', 'degree', 'deleted_at', 'education', 'email', 'first_name', 'is_author', 'last_name', 'mobile', 'national_id', 'nationality', 'nickname', 'passport_no', 'phone', 'title', 'updated_at', 'work_experience'];



    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'json',
        'education' => 'json',
        'degree' => 'json',
        'nationality' => 'json',
        'first_name' => 'json',
        'last_name' => 'json',
        'nickname' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['birthday', 'created_at', 'deleted_at', 'updated_at'];

    public function visits()
    {
        return $this->hasMany(Visit::class, 'user_id');
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'user_id')->latest();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actionHubs()
    {
        return $this->hasMany('App\Models\ActionHub');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleHubs()
    {
        return $this->hasMany('App\Models\ArticleHub');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paleontologyActions()
    {
        return $this->hasMany('App\Models\PaleontologyAction');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paleontologyCitations()
    {
        return $this->hasMany('App\Models\PaleontologyCitation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paleontologyMedias()
    {
        return $this->hasMany('App\Models\PaleontologyMedia');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plants()
    {
        return $this->hasMany('App\Models\Plant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedHubs()
    {
        return $this->hasMany('App\Models\SeedHub');
    }
}
