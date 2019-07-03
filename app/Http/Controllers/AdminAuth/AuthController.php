<?php

namespace App\Http\Controllers\AdminAuth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
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
    protected $redirectTo = '/admin/dashboard';


    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }


    public function login(AdminLoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect('admin')
            ->withErrors([
                'email' => 'مشخصات وارد شده صحیح نیست / دسترسی شما به این بخش مسدود شده است',
            ])
            ->withInput($request->only('admin', 'remember'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin');
    }
}
