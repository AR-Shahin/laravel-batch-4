<?php

namespace App\Http\Middleware;

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
        if ($request->is('admin/*')) {
            if (!Auth::guard('admin')->check()) {
                return route('admin.login');
            }
        }
        if ($request->is('seller/*')) {
            if (!Auth::guard('seller')->check()) {
                return route('seller.login');
            }
        }
        if ($request->is('agent/*')) {
            if (!Auth::guard('agent')->check()) {
                return route('agent.login');
            }
        }
        // elseif (!Auth::guard('web')->check()) {
        //     return route('login');
        // }
    }
}
