<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $title
 * @property mixed $education
 * @property mixed $degree
 * @property int $national_id
 * @property string $birthday
 * @property mixed $nationality
 * @property string $passport_no
 * @property mixed $first_name
 * @property mixed $last_name
 * @property mixed $nickname
 * @property boolean $is_author
 * @property string $mobile
 * @property string $phone
 * @property string $email
 * @property int $work_experience
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property ActionHub[] $actionHubs
 * @property ArticleHub[] $articleHubs
 * @property Attendance[] $attendances
 * @property Borrow[] $borrows
 * @property Media[] $medias
 * @property PaleontologyAction[] $paleontologyActions
 * @property PaleontologyCitation[] $paleontologyCitations
 * @property PaleontologyMedia[] $paleontologyMedias
 * @property Plant[] $plants
 * @property SeedHub[] $seedHubs
 * @property Visit[] $visits
 */
class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'education', 'degree', 'national_id', 'birthday', 'nationality', 'passport_no', 'first_name', 'last_name', 'nickname', 'is_author', 'mobile', 'phone', 'email', 'work_experience', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

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
    public function borrows()
    {
        return $this->hasMany('App\Models\Borrow');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits()
    {
        return $this->hasMany('App\Models\Visit');
    }
}
