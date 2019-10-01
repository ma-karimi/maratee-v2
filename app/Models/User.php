<?php

namespace App\Models;

use App\Models\Accessor\UserAccessor;
use App\Models\Scope\UserScope;
use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jedrzej\Searchable\SearchableTrait;
use Laravel\Passport\HasApiTokens;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={"title","email","first_name","last_name","password"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="education",
 *          description="education",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="degree",
 *          description="degree",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="national_id",
 *          description="national_id",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="birthday",
 *          description="birthday",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="nationality",
 *          description="nationality",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="passport_no",
 *          description="passport_no",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="first_name",
 *          description="first_name",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="last_name",
 *          description="last_name",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="nickname",
 *          description="nickname",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="is_author",
 *          description="is_author",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="mobile",
 *          description="mobile",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="work_experience",
 *          description="work_experience",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class User extends Authenticatable
{

    public static $linguistically = ['title' => true, 'education' => false, 'degree' => false, 'nationality' => false, 'first_name' => true, 'last_name' => true, 'nickname' => false];
    public static $rules = [
        'national_id' => 'string',
        'passport_no' => 'string',
        'birthday' => 'date',
        'is_author' => 'integer',
        'mobile' => 'string',
        'email' => 'required|email',
        'phone' => 'string',
        'password' => 'required|string',
        'work_experience' => 'integer',
        'first_name' => 'required',
        'last_name' => 'required',
    ];
    public static $messages = [];

    use HasApiTokens, UserScope, UserAccessor, Notifiable;
    public static $searchable = ['*'];
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

    /**
     * BaseModel constructor.
     * @param array $attributes
     * @throws Exception
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $languages = config('settings.languages');
        $this->exceptionLanguageHandler($languages);
        $this->validateJsonRequestHandler($languages);
        $this->setNotSearchable($this->getLinguistically());
    }

    /**
     * @param $languages
     * @return mixed
     * @throws Exception
     */
    private function exceptionLanguageHandler($languages)
    {

        foreach (request()->all() as $field => $value) {
            if (is_array($value) &&
                array_key_exists($field, static::$linguistically) &&
                count(array_intersect($languages, array_keys($value))) === 0) {
                throw new Exception('Language doesnt supported. [' . implode(',', $languages) . ']');
            }
        }
    }

    /**
     * @param $languages
     */
    private function validateJsonRequestHandler($languages): void
    {
        foreach ($this->getLinguistically() as $key => $value) {
            if ($value) {
                static::$rules[$key] = 'required|array';
            } else {
                static::$rules[$key] = 'sometimes|required|array';
            }
            foreach ($languages as $language) {
                if (is_array(request()->get($key)) && array_key_exists($language, request()->$key)) {
                    static::$rules[$key . '.' . $language] = 'sometimes|required|min:3';
                    static::$messages[$key . '.' . $language . '.' . 'required'] = ' الزامی است' . $key . 'فیلد';
                    static::$messages[$key . '.' . $language . '.' . 'min'] = 'حداقل ۳ کاراکتر الزامی است';
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getLinguistically(): array
    {
        return static::$linguistically;
    }

    /**
     * @param array $fields
     */
    public function setNotSearchable(array $fields): void
    {
        $this->notSearchable = array_merge($this->notSearchable, array_keys($fields));
    }

    /**
     * Find the user instance for the given username.
     *
     * @param string $username
     * @return User
     */
    public function findForPassport($username)
    {
        $request = request()->all();
        if (strpos($request['username'], '@')) {
            return $this->where('email', $username)->first();
        } else {
            return $this->where('national_id', $username)->first();
        }
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @return HasMany
     */
    public function actionHubs()
    {
        return $this->hasMany(ActionHub::class)->latest();
    }

    /**
     * @return MorphToMany
     */
    public function articles(): MorphToMany
    {
        return $this->morphToMany(Article::class,
            'articleable', 'article_hubs')
            ->whereNull('location_hubs.deleted_at')
            ->withTimestamps();
    }

    public function userHubs()
    {
        return $this->morphedByMany(UserHub::class, 'userable');
    }

    /**
     * @return HasMany
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function paleontologyMedias()
    {
        return $this->hasMany(PaleontologyMedia::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function plants()
    {
        return $this->hasMany(PlantHerbarium::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function seedHubs()
    {
        return $this->hasMany(SeedHub::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function connection()
    {
        return $this->hasMany(Connection::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function permission()
    {
        return $this->hasMany(User::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class)->latest();
    }
}
