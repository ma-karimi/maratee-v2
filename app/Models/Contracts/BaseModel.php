<?php


namespace App\Models\Contracts;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Jedrzej\Searchable\SearchableTrait;


class BaseModel extends Model

{
    use SoftDeletes, SearchableTrait;
    public static $rules = [];
    public static $jsons = [];
    public static $messages = [];
    public $searchable = ['*'];
    public $notSearchable = ['page', 'per_page', 'limit', 'skip', 'relations'];

    /**
     * The attributes that have en,fa languages.
     **/
    public static $linguistically = [];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

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
        $this->setJsonSearchables();

    }

    /**
     * @param array $fields
     */
    public function setNotSearchable(array $fields): void
    {
        $this->notSearchable = array_merge($this->notSearchable, array_keys($fields));
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

    protected static function boot()
    {
        parent::boot();
        if (count(request()->keys())) {
            foreach (request()->all() as $index => $item) {
                if (is_array($item) && collect(parent::getLinguistically())->has($index)) {
                    foreach (parent::getJsons() as $key => $value) {
                        static::addGlobalScope('json:' . $key, function (Builder $builder) use ($value, $key) {
                            $builder->where($key, $value['operator'], $value['value']);
                        });
                    }
                }
            }
        }

    }

    /**
     * @return array
     */
    public static function getJsons(): array
    {
        return static::$jsons;
    }

    protected function setJsonSearchables(): void
    {
        if (count(request()->keys())) {
            foreach (request()->all() as $index => $item) {
                if (is_array($item) && collect($this->getLinguistically())->has($index)) {
                    $param = array_keys($item)[0];
                    $value = array_values($item)[0];
                    static::$jsons[$index . '->' . $param]['operator'] = Str::startsWith($value, '%') || Str::endsWith($value, '%') ? 'like' : '=';
                    static::$jsons[$index . '->' . $param]['value'] = $value;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getNotSearchable(): array
    {
        return $this->notSearchable;
    }
}
