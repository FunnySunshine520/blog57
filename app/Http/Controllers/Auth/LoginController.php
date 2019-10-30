<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\LoginTrait;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use LoginTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // 多个终端限制？
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();

            if ($user->active == 0) {
                $this->incrementLoginAttempts($request);
                abort(403, '账户已被冻结');
            }
//            var_dump($user);die;
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request); // 增加用户的登录尝试

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
//        $user->api_token = Str::random(64);
//        $user->save();

        return $this->success($user);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return $this->failed('账号密码错误, 请重新输入');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
