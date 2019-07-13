<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
                'email' => 'required|string|email|max:255',
            ];
        } else {
            return [
                'password' => 'required|string|min:4|confirmed',
                'title' => 'required|string|max:255',
                'first_name' => 'required',
                'last_name' => 'required',
                'is_author' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'national_id' => 'required|numeric|unique:users',
            ];
        }

    }
}
