<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UserRequest;
use App\Notifications\ResetPassword;
use App\Services\UserServices;
use App\Utility;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;

/**
 * @property UserServices userServices
 */
class AuthOldController extends AppBaseController
{
    use AuthenticatesUsers;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function resetPassword(UserRequest $request)
    {
        $user = $this->userServices->findByEmail($request->email);
        if (!$user) {
            return $this->sendError('User not found');
        }

        try {
            $newPassword = Utility::randomStringGenerator(6);
            $this->userServices->updateUserWithNewPassword($user, $newPassword);
            $user->notify(new ResetPassword($newPassword));
            return $this->sendResponse($user, 'The Password reset token and sent to Email');
        } catch (Exception $exception) {
            report($exception);
            return $this->sendError($exception->getMessage());
        }

    }


}
