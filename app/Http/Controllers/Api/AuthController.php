<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterUpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends AppBaseController
{
    /**
     * @param UserRegisterUpdateRequest $request
     *
     * @SWG\Post(
     *      path="/register",
     *      summary="Register New User",
     *      tags={"Action"},
     *      description="Register New User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          description="Register that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Action")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Action that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Action")
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
     *                  ref="#/definitions/Action"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterUpdateRequest $request)
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

    public function update(UserRegisterUpdateRequest $request)
    {
        $user = new User([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request)
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
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
