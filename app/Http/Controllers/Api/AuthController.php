<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\UserLoginRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use App\Notifications\ResetPassword;
use App\Repositories\UserRepository;
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

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
            $token->expires_at = Carbon::now()->addDay();
        }
        $token->save();

        $roles = Role::where(['model_id'=>$user->id, 'model_type'=>User::class])->whereNull('deleted_at')->pluck('role_id')->toArray();

        $roleHasPermissions = RoleHasPermission::whereIn('role_id', $roles)->pluck('permission_id')->toArray();

        $permissions = Permission::whereIn('id', collect($roleHasPermissions)->filter()->all())->pluck('name')->toArray();

//        $permissions = $user->getAllPermissions()->map(function ($permission) {
//            return $permission->name;
//        });

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'permissions' => $permissions
        ]);
    }

    /**
     * @param Request $request
     * @return Response|JsonResponse
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

    public function user(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $permissions = $user->getAllPermissions()->pluck('name');
            unset($user->roles, $user->permissions);
            return response()->json(['authenticated' => true, 'user' => $user, 'permissions' => $permissions]);
        }

        return response()->json(['authenticated' => false]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $change_password = false;
        $record = $this->userRepository->updateUser($request->all(), $user->id);
        if ($request->filled('password')) {
            $change_password = true;
        }
        return response()->json(['user' => $record, 'change_password' => $change_password]);
    }
}
