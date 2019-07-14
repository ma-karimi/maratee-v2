<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Notifications\ResetPassword;
use App\Services\UserServices;
use App\Utility;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * @property UserServices userServices
 */
class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request)
    {
        $success = [];
        $user = $this->userServices->create($request);
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
        $user = $this->userServices->findByEmail($request->email);
        if (!$user) {
            return $this->responser('کاربری با این ایمیل یافت نشد');
        } else {
            try{
            $newPassword = Utility::randomStringGenerator(6);
            $this->userServices->updateUserWithNewPassword($user, $newPassword);
            $user->notify(new ResetPassword($newPassword));
            return $this->responser('ایمیل حاوی رمز عبور جدید ارسال شد');
            }catch(\Exception $exception)
            {
                return $this->responser($exception);
            }

        }

    }


}
