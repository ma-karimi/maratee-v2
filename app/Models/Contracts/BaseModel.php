<?php


namespace App\Models\Contracts;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    //use SoftDeletes;

    public static $rules = [];
    public static $messages = [];

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

}