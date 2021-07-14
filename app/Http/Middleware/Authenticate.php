<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, $guard = null)
    {


        //Set $request->user() to Auth::guard('api')->user();
        if (Auth::guard($guard)->user() && $guard == 'api') {
            $request->setUserResolver(function () use ($guard) {
                return Auth::guard($guard)->user();
            });
        }
    }
}
