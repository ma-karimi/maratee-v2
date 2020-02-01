<?php

namespace App\Models;

use App\Models\Accessor\UserAccessor;
use App\Models\Scope\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jedrzej\Searchable\SearchableTrait;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={"email","name","password"},
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, UserScope, UserAccessor, Notifiable, SearchableTrait, HasRoles;

    public const GROUPS = [1 => 'Botanical Flora', 2 => 'Botanical NonFlower', 3 => 'Botanical Paleobotany', 4 => 'Botanical Garden', 5 => 'Botanical Gene Bank', 6 => 'Medicinal', 7 => 'BioTech'];
    public $searchable = ['*'];
    public $notSearchable = ['page', 'per_page', 'limit', 'skip', 'relations'];
    protected $hidden = ['password'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];


    /**
     * @param array $fields
     */
    public function setNotSearchable(array $fields): void
    {
        $this->notSearchable = array_merge($this->notSearchable, array_keys($fields));
    }


    /**
     * @param $value
     */
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
