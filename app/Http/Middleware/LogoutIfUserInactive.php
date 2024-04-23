<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutIfUserInactive
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
        if (auth()->user()->status !== User::STATUS['ACTIVE']) {
            auth()->logout();
            return redirect(route('web.login'))->with('error', 'Forced Log Out');
        }

        return $next($request);
    }
}
