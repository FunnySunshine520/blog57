<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Gate;

class Authenticate
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param string|null $guard
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $routeName = app('router')->currentRouteName();

//        dd($routeName);
//        throw new \Exception(json_encode($routeName));
        // 如果未登录
//        var_dump(Auth::guard($guard)->guest());die;

//        if (Auth::guard($guard)->guest()) {
//            if ($request->ajax() || $request->wantsJson()) {
//                return response()->json([
//                    'code' => 401,
//                    'msg' => '您登录已过期，请重新登录。',
//    //                'redirect'=>url_login($refererHost),
//                ], 401);
//            } else {
//                return redirect('/');
//            }
//        }

        $user = Auth::user();
        app()->instance('user', $user);
        // app()->instance('log-formats', Auth::user()->getLogFormats());
        // 如果已登录
        if (!$user->activated) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'code' => 401,
                    'msg' => '您的账户已被禁用，请联系管理员获取更多访问权限。'
                ])->setStatusCode(401);
            } else {
                return response('您的账户已被禁用，请联系管理员获取更多访问权限。', 401);
            }
        }

        if(Gate::denies($routeName) && !$user->isSuper()){
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'code' => 403,
                    'msg' => '您的权限不足，请联系管理员获取更多访问权限。'
                ])->setStatusCode(403);
            } else {
                return response('您的权限不足，请联系管理员获取更多访问权限。', 403);
            }
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
//        if (! $request->expectsJson()) {
//            return route('login');
//        }
    }
}
