<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutIfAdminInactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->user()->status !== Admin::STATUS['ACTIVE']) {
            Auth::guard('admin')->logout();
            return redirect(route('admin.login'))->with('error', 'Being forced logout because user is not active');
        }

        return $next($request);
    }
}
