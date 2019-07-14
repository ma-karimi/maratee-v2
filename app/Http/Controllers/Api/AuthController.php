<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request)
    {
        $success = [];
        $user = User::create([
            'national_id' => !strpos($request->identifier, '@') ? $request->national_id : null,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'title' => $request->title,
            'email' => strpos($request->identifier, '@') ?? $request->email,
            'password' => Hash::make($request->password),

        ]);

        $success['token'] = $user->createToken('Laravel Password Grant Client')->accessToken;
        $success['user'] = $user->toArray();
        return $this->responser($success);
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(UserRequest $request)
    {
        $user = User::ofEmail($request->email)->first();
        if (!$user){
            return $this->responser('کاربری با این ایمیل یافت نشد');
        }else {
            $user->notify(new ResetPassword($user));
        }
    }
}
