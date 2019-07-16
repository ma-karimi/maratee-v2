<?php


namespace App\Models\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    public static $rules = [];
    public static $messages = [];
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
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    /**
     * BaseModel constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $jsons = array_filter($this->getCasts(), function ($key) {
            return $key === 'json';
        });

        foreach ($jsons as $key => $value) {
            foreach (config('settings.languages') as $language) {
                if (!empty(request()->get($key)) && array_key_exists($language, request()->$key)) {
                    static::$rules[$key . '.' . $language] = 'sometimes|required|min:3';
                    static::$messages[$key . '.' .$language.'.'. 'required'] = ' الزامی است'.$key.'فیلد';
                    static::$messages[$key . '.' .$language.'.'. 'min'] = 'حداقل ۳ کاراکتر الزامی است' ;
                }
            }
        }

    }

}