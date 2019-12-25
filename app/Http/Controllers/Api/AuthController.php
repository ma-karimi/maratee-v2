<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
use App\Notifications\ResetPassword;
use App\Services\UserServices;
use App\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends AppBaseController
{
    use AuthenticatesUsers;

    private $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * @param UserRegisterRequest $request
     *
     * @SWG\Post(
     *      path="/register",
     *      summary="Register New User",
     *      tags={"Auth"},
     *      description="Register New User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="first_name",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="last_name",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="email",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="education",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="degree",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="national_id",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="birthday",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="nationality",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="passport_no",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="nickname",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="is_author",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="mobile",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="phone",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="work_experience",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/User"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @return JsonResponse
     * @throws Exception
     */
    public function register(UserRegisterRequest $request)
    {
        $user = new User([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * @param UserLoginRequest $request
     *
     * @return JsonResponse
     * @SWG\Post(
     *      path="/login",
     *      summary="Login User",
     *      tags={"Auth"},
     *      description="Register New User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="email",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="remember_me",
     *          in="body",
     *          description="Register that should be stored",
     *          required=false,
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/User"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function login(UserLoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/logout",
     *      summary="Logout User.",
     *      tags={"Auth"},
     *      description="Logout User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          type="string",
     *          in="header",
     *          required=true
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Action")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }


    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/reset_password",
     *      summary="Reset User Password By Email.",
     *      tags={"Auth"},
     *      description="Reset User Password By Email",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="email",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Action")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = $this->userServices->findByEmail($request->email);
        if (!$user) {
            return $this->sendError('User not found');
        }

        try {
            $newPassword = Utility::randomStringGenerator(6);
            $this->userServices->updateUserWithNewPassword($user, $newPassword);
            $user->notify(new ResetPassword($newPassword));
            return $this->sendResponse(null, 'The Password reset token and sent to Email');
        } catch (Exception $exception) {
            report($exception);
            return $this->sendError($exception->getMessage());
        }
    }
}
