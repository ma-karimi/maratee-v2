<?php

namespace App\Http\Controllers\AdminAuth;


use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Smsauthenticate\Exceptions\User\UserNotFoundException;
use Smsauthenticate\Http\Requests\LoginRequest;
use Smsauthenticate\Models\Group;
use Smsauthenticate\Models\User;


class ProviderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/panel/provider/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:provider')->except('logout');

    }

    public function username()
    {
        return 'cellphone';
    }
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {

        $credentials = $request->only('cellphone');
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        try {
            $user = User::where($credentials)->first();
            if ($user) {
                if (Hash::check($request['password'], $user->password)) {
                    $this->throwCredentialWhenAlreadySetupUserGroup($user);
                    $this->guard()->login($user);
                    $this->verifyUser($user);
                    Provider::firstOrCreate(['user_id' => $user->id]);
                    $this->setUserGroupWhenGroupIsNull($user);
                    if ($user->has_password == 0) {
                        $user->forgetToken();
                    }
                    return response()->json('operation successfully');
                } else {
                    $this->incrementLoginAttempts($request);

                    throw new UserNotFoundException('invalid credentials');
                }
            } else {
                $this->incrementLoginAttempts($request);

                throw new UserNotFoundException('invalid credentials');
            }
        } catch (UserNotFoundException $e) {
            $this->incrementLoginAttempts($request);

            return response()->json(['message' => 'اطلاعات وارد شده صحیح نمیباشد'], 403);
        }
    }

    protected function guard()
    {
        return Auth::guard('provider');
    }

    /**
     * @param $user
     */
    private function verifyUser($user)
    {
        if ($user->authenticated == '0') {
            $user->update(['authenticated' => 1]);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        $this->guard()->logout();
        return redirect('/panel/provider');
    }

    /**
     * @param $user
     */
    private function setUserGroupWhenGroupIsNull($user): void
    {
        if (empty($user->group_id)) {
            $user->update(['group_id' => Group::SALOON]);
        }
    }

    /**
     * @param $user
     */
    private function throwCredentialWhenAlreadySetupUserGroup($user): void
    {
        if (!empty($user->group_id) && !in_array($user->group_id, [Group::FREELANCER, Group::SALOON])) {
            throw new UserNotFoundException('invalid credentials');
        }
    }
}
