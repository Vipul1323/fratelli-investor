<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $guard = 'admin';
        if (Auth::guard($guard)->check()) {
            if ($request->route()->getPrefix() == '/admin') {
                $allowed = [
                    'admin.dashboard',
                    'admin.logout',
                    'admin.edit.admin',
                    'admin.change.password',
                    'admin.users.editfield',
                    'admin.subadmin.editfield',
                ];
                $routeName = $request->route()->getName();
                if (Auth::guard($guard)->user()->hasRole('superadministrator') || Auth::guard($guard)->user()->isAbleTo($routeName)) {
                    return $next($request);
                } elseif (in_array($routeName, $allowed)) {
                    return $next($request);
                } else {
                    abort(403, 'Access denied');
                }

                /*Super admin*/
                return $next($request);
            }
        } else {
            return new RedirectResponse(url('/admin/signin'));
        }
    }
}
