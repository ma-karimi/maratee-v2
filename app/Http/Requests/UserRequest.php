<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (strpos($this->url(), 'password')) {
            return [
                'email' => 'required|string|email|min:3',
            ];
        } else {
            return [
                'password' => 'required|string|min:6|confirmed',
                'title' => 'required|string|min:3',
                'first_name' => 'required|string|min:3',
                'last_name' => 'required|string|min:3',
                'is_author' => 'required',
                'email' => 'required|string|email|min:3|unique:users',
                'national_id' => 'required|numeric',
            ];
        }

    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => 'این بخش الزامی است',
            'title.required' => 'این بخش الزامی است',
            'first_name.required' => 'این بخش الزامی است',
            'last_name.required' => 'این بخش الزامی است',
            'is_author.required' => 'این بخش الزامی است',
            'email.required' => 'این بخش الزامی است',
            'national_id.required' => 'این بخش الزامی است',
            'title.string' => 'فقط کاراکتر قابل قبول است',
            'first_name.string' => 'فقط کاراکتر قابل قبول است',
            'last__name.string' => 'فقط کاراکتر قابل قبول است',
            'national_id.numeric' => 'فقط عدد  قابل قبول است',
            'email.email' => 'فرمت ایمیل وارد شده صحیح نمیباشد',
            'email.min' => 'حداقل ۳ کاراکتر الزامی است',
            'title.min' => 'حداقل ۳ کاراکتر الزامی است',
            'password.min' => 'حداقل 6 کاراکتر الزامی است',
            'first_name.min' => 'حداقل ۳ کاراکتر الزامی است',
            'last_name.min' => 'حداقل ۳ کاراکتر الزامی است',
            'email.unique' => 'این ایمیل قبلا در سیستم ثبت شده است',
        ];
    }
}
